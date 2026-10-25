import { readFileSync } from 'node:fs';
import { runInNewContext } from 'node:vm';
import test from 'node:test';
import assert from 'node:assert/strict';
const source = readFileSync(new URL('../../resources/js/raslo-tracking.js', import.meta.url), 'utf8');
function fixture(fetchImpl) {
    const timers = new Map();
    const listeners = {};
    const elements = {};
    let timerId = 0;
    let requests = 0;
    for (const name of ['delivery-status', 'tracking-number', 'tracking-updated', 'tracking-link', 'tracking-error']) {
        elements[`[data-${name}]`] = { textContent: 'saved', hidden: true, removeAttribute(name) { delete this[name]; } };
    }
    const root = { dataset: { statusUrl: '/orders/1/delivery' }, querySelector: key => elements[key] };
    const document = { hidden: false, querySelector: () => root, addEventListener: (name, fn) => { listeners[name] = fn; } };
    runInNewContext(source, { document, window: { addEventListener: (name, fn) => { listeners[name] = fn; } },
        AbortController, URL,
        fetch: (...args) => { requests++; return fetchImpl(...args); },
        setTimeout: (fn, ms) => { timers.set(++timerId, { fn, ms }); return timerId; }, clearTimeout: id => timers.delete(id),
    });
    return { document, elements, listeners, timers, requests: () => requests,
        async tick() { const entry = [...timers].find(([, timer]) => timer.ms === 30000); assert.ok(entry); timers.delete(entry[0]); await entry[1].fn(); } };
}
test('refresh uses an authenticated local GET and inserts status as text', async () => {
    const f = fixture(async (url, options) => {
        assert.equal(url, '/orders/1/delivery'); assert.equal(options.credentials, 'same-origin'); assert.equal(options.cache, 'no-store');
        return { ok: true, json: async () => ({ status_label: '<img src=x>', tracking_number: 'RS-1', tracking_url: 'https://raslo.example/track/x', updated_at: 'now' }) };
    });
    await f.tick();
    assert.equal(f.elements['[data-delivery-status]'].textContent, '<img src=x>');
    assert.equal(f.elements['[data-tracking-link]'].href, 'https://raslo.example/track/x');
    assert.equal(f.elements['[data-tracking-error]'].hidden, true);
});
test('background pages do not poll and navigation removes scheduled work', async () => {
    const f = fixture(async () => { throw new Error('Unexpected request'); });
    f.document.hidden = true; await f.tick(); assert.equal(f.requests(), 0);
    f.listeners['livewire:navigating'](); assert.equal(f.timers.size, 0);
});
test('refresh failure retains saved status and schedules retry', async () => {
    const f = fixture(async () => { throw new Error('offline'); });
    await f.tick(); assert.equal(f.elements['[data-delivery-status]'].textContent, 'saved');
    assert.equal(f.elements['[data-tracking-error]'].hidden, false);
    assert.ok([...f.timers.values()].some(timer => timer.ms === 30000));
});
test('unsafe tracking URLs never become clickable', async () => {
    const f = fixture(async () => ({ ok: true, json: async () => ({ status_label: 'Completed', tracking_url: 'javascript:alert(1)' }) }));
    await f.tick(); assert.equal(f.elements['[data-tracking-link]'].hidden, true);
    assert.equal(f.elements['[data-tracking-link]'].href, undefined);
});
