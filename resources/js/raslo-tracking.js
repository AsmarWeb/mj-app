// Read owned local status only; never call Raslo or expose credentials in a browser.
let stopTracking = () => {};
function startTracking() {
    stopTracking();
    const root = document.querySelector('[data-raslo-tracking]');
    if (!root) return;
    let stopped = false;
    let timer;
    let controller;
    const error = root.querySelector('[data-tracking-error]');
    const poll = async () => {
        if (stopped) return;
        if (!document.hidden) {
            controller = new AbortController();
            const timeout = setTimeout(() => controller.abort(), 10000);
            try {
                const response = await fetch(root.dataset.statusUrl, {
                    headers: { Accept: 'application/json' }, credentials: 'same-origin',
                    cache: 'no-store', signal: controller.signal,
                });
                if (!response.ok || response.redirected) throw new Error('Unavailable');
                const data = await response.json();
                if (stopped) return;
                root.querySelector('[data-delivery-status]').textContent = data.status_label;
                root.querySelector('[data-tracking-number]').textContent = data.tracking_number || '—';
                root.querySelector('[data-tracking-updated]').textContent = data.updated_at || '—';
                const link = root.querySelector('[data-tracking-link]');
                link.hidden = true;
                link.removeAttribute('href');
                if (data.tracking_url) {
                    const url = new URL(data.tracking_url);
                    if (url.protocol === 'https:' && !url.username && !url.password) {
                        link.href = url.href;
                        link.hidden = false;
                    }
                }
                error.hidden = true;
            } catch (_) {
                if (!stopped) error.hidden = false;
            } finally { clearTimeout(timeout); }
        }
        if (!stopped) timer = setTimeout(poll, 30000);
    };
    stopTracking = () => { stopped = true; clearTimeout(timer); controller?.abort(); };
    timer = setTimeout(poll, 30000);
}
startTracking();
document.addEventListener('livewire:navigated', startTracking);
document.addEventListener('livewire:navigating', () => stopTracking());
window.addEventListener('pagehide', () => stopTracking());
window.addEventListener('pageshow', (event) => { if (event.persisted) startTracking(); });
