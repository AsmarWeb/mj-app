# Native mobile authentication

This is the Laravel foundation for an Android/iOS Expo client, not a completed mobile application. It uses the existing Sanctum token table and Fortify account/password/2FA rules. No schema migration, dependency upgrade, .env edit or APP_KEY change is needed.

## Contract

All paths below start with `/api/v1/auth`. Send `Accept: application/json` and `Content-Type: application/json`. Use HTTPS outside isolated local testing. A machine-readable contract is in [mobile-auth-openapi.json](mobile-auth-openapi.json); the existing catalog OpenAPI remains catalog-only.

| Method/path | Authentication | Result |
| --- | --- | --- |
| POST /register | None | 201: create a normal user and one device token |
| POST /login | Email/password plus existing 2FA if enabled | 200: issue a device token |
| GET /me | Mobile bearer token | 200: allowlisted profile |
| POST /logout | Mobile bearer token | 204: revoke the current token only |
| GET /devices | Mobile bearer token | 200: own active mobile token labels/IDs/dates, never token bytes |
| DELETE /devices/{id} | Mobile bearer token | 204: revoke an owned mobile token; otherwise 404 |
| POST /email/verification-notification | Mobile bearer token | 202: resend existing web verification notification; 200 if already verified; 503 if mail unavailable |

Register body:

```json
{"name":"Example Buyer","email":"buyer@example.test","password":"a-long-unique-password","password_confirmation":"a-long-unique-password","terms":true,"device_name":"My iPhone"}
```

Login body:

```json
{"email":"buyer@example.test","password":"a-long-unique-password","device_name":"My iPhone"}
```

Email input is trimmed and lowercased. Login uses email, not username/social-provider tokens. Device names are user-provided labels, not verified hardware identities. Registration reuses the existing web action, including reserved-name checks, password confirmation, terms and normal user-role assignment. Client-supplied roles, verification timestamps, provider IDs and billing fields are ignored.

Login/register responses use:

```json
{"data":{"access_token":"TOKEN_RETURNED_ONCE","token_type":"Bearer","expires_at":"2026-11-25T10:00:00.000000Z","user":{"id":1,"name":"Example Buyer","username":"example-buyer","email":"buyer@example.test","phone":null,"email_verified":false,"phone_verified":false,"two_factor_enabled":false,"profile_photo_url":"https://example.test/avatar.png"}}}
```

Registration also returns `verification_notification_sent`. If notification delivery fails, the created account/token remain usable and this flag is false; retry via the authenticated resend route. No registration event is re-emitted on resend.

## Two-factor authentication

Correct email/password is insufficient when the account's existing Fortify 2FA is enabled. A 422 response has `errors.code`; submit email/password/device_name again with either `code` (six digits) or `recovery_code`. Sending both is rejected. The Fortify provider handles TOTP validation/replay behavior. Recovery-code consumption and token creation share the user transaction/row lock, preventing concurrent reuse of a recovery code. Do not log passwords, codes or tokens.

## Tokens and permissions

- Tokens are random bearer secrets; only their SHA-256 hash is stored by Sanctum. Responses are private/no-store.
- Issued tokens have only `mobile:account` and expire after 30 days. An existing shorter global Sanctum lifetime still applies.
- Maximum 20 mobile tokens per account; active tokens are not silently removed on login. Expired mobile tokens are cleaned up when another token is issued.
- The versioned protected routes require a real bearer token with the explicit mobile ability. A web session, read-only token or legacy wildcard token does not count as this mobile token.
- Mobile login does not log a browser session in; logout does not invalidate other devices or browser sessions.
- Ordinary web password changes/resets retain their existing behavior; this patch does not add global token revocation to those workflows. Use device revocation when needed.
- Email/phone verification flags are reported, never auto-approved. Existing seller/payment routes are not exposed by this patch. Future mobile business endpoints must check ownership, role and verification explicitly in addition to token abilities.

The legacy `/api/user` keeps its root-level JSON shape and existing Sanctum access, but now returns the same safe profile allowlist instead of a raw User model. Undocumented billing/provider fields are removed; callers relying on them must adapt. `/api/v1/auth/me` uses `data` wrapping.

## Verification and recovery boundaries

Email verification still uses the current signed website link and may require signing in on the website. Native deep-link verification, password-reset API, social login and phone-verification API are separate work. Until implemented, the mobile UI should open the existing website flow. An unverified token can inspect its own account and manage its devices; it does not bypass existing verification requirements.

## Rate limits

- Login: 5 requests/minute per normalized email+IP; 20/minute per IP, including 2FA attempts.
- Registration: 3/minute and 5/hour per IP.
- Authenticated account routes: 60/minute per account.
- Verification resend: 1/minute and 3/hour per account.

Use 429/Retry-After in the client. Limits include successful attempts. Shared cache and trusted-proxy configuration remain operator responsibilities; no configuration is changed here.

## Expo client behavior

Store native tokens in SecureStore; send `Authorization: Bearer <token>` for protected requests. Clear the local token after successful logout or a 401, and prompt for credentials again after expiry. Do not treat 403/422/429 as automatic logout. A 403 is a permission failure, 422 contains validation/2FA errors and 429 requires waiting. Keep service credentials and signing secrets on Laravel. No token-refresh endpoint is provided.

For Expo web/other first-party browser clients, retain the separate cookie/CSRF web authentication design; do not put native bearer secrets in browser localStorage. Validate real-device HTTPS connectivity when building the Expo app.

## Applying

The installer applies source/tests/docs and creates a local branch/commit. It runs no migrations, account requests, notifications, dependency installers, deployment or runtime cache commands. Existing route caches must be rebuilt during an authorized application update before new endpoints appear. The current personal_access_tokens table must already exist from the project's existing migrations.
