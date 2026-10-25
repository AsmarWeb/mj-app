# murwaj rollout and repository rename

## Apply and verify

Save the previously applied checkout-experience update in a commit first. Apply this package on a development branch, back up database/storage, then run:

```sh
composer install
npm ci --include=optional
php artisan optimize:clear
php artisan migrate
php artisan digital:secure-files
# After reviewing the dry-run and taking a storage backup:
php artisan digital:secure-files --apply
npm run build
php artisan test
npm run test:frontend
php artisan view:cache
php artisan route:cache
php artisan queue:restart
```

For an existing Sail installation prefix Composer/Artisan with `./vendor/bin/sail`; use native npm on macOS or an isolated container dependency directory. Restart `raslo-queue` and `raslo-scheduler` using both Compose files. The update contains no new schema migration, but `migrate` safely verifies all previous migrations are present. Do not use `migrate:fresh`.

New application code requires Laravel 12 and the updated lock. Run Composer installation before executing the updated app. Locks are resolved for PHP 8.2; the existing Sail runtime is PHP 8.3. Application tests passed on PHP 8.4 here; verify your actual host before deployment.

## Digital-file migration

The public-storage exposure is not fixed for existing files merely by installing code. New uploads and application downloads use the private disk. Existing entitled downloads fail closed until their file has been moved successfully.

`digital:secure-files --apply` uses current digital-product file references, copies to the private disk, verifies hashes and removes only the matching public copy. It does not change payment entitlements or database file paths. Repeating it is safe. Review every failure; missing files, conflicting private copies and permissions need operator correction. Preserve a private backup and clear any external CDN cache. A leaked public file URL cannot be revoked in copies already downloaded elsewhere.

## Rename GitHub repository

The connector used for this review has no repository-administration/rename tool, and the browser session is signed out. **The GitHub repository has not been renamed by this package.**

As the owner, open the existing repository's Settings → General → Repository name, enter `murwaj`, and choose Rename. Then update your local remote:

```sh
git remote set-url origin https://github.com/AsmarWeb/murwaj.git
git remote -v
```

Do not rename Docker volumes, queues, database files, payment IDs or existing Raslo references. Keep the local `mj-app` folder for this rollout. If another repository already uses `murwaj`, resolve that collision rather than overwriting it. Review external GitHub integrations/deploy hooks after a rename. README clone instructions use the existing URL until the owner completes this step.

## Historical SSH failure

Latest inspected run: `33500085865`, commit `78d66a5`, 2026-09-01. Build succeeded, then SSH authentication failed: `unable to authenticate, attempted methods [none publickey]`. The action also ignored the unsupported `script_stop` input. Updating workflow syntax cannot correct the existing server credentials.

Configure these values in GitHub's `production` environment:

| Type | Name | Value |
| --- | --- | --- |
| Secret | SSH_HOST | Your Hostinger SSH hostname |
| Secret | SSH_USERNAME | The SSH login user |
| Secret | SSH_PORT | Actual SSH port |
| Secret | SSH_KEY | Dedicated unencrypted private deployment key; matching public key installed for this user on the server |
| Secret | SSH_KNOWN_HOSTS | Host-key entry independently verified from the hosting provider; include `[host]:port` format for nonstandard ports |
| Variable | DEPLOY_PATH | Absolute path to the existing application Git checkout containing artisan and .env |
| Variable | DEPLOY_PHP | Absolute path to a compatible PHP binary, e.g. your host's installed PHP 8.3/8.4 binary |

Never paste keys into chat, issue bodies or the repository. Verify the host fingerprint independently; do not disable host checking to resolve authentication failures. The deploy job validates an unencrypted private key format; passphrase-protected keys need an explicitly configured agent flow instead.

The server checkout must be on `main`, have no tracked local edits, contain `composer.phar`, and be able to fetch the repository. Deploy checks that origin/main still equals the tested commit, performs a fast-forward update, installs locked production dependencies, uploads matching build assets, migrates, clears config, caches views and signals queue restart. The workflow does not recreate Docker services or install server cron/Supervisor. Existing digital-file migration is an operator step before enabling digital downloads.

This is still an in-place deployment. Partial failure can leave code/assets mismatched; use a staging environment and a maintenance window. Atomic release directories, a tested rollback and health verification are recommended before production. Do not assume a green local build proves SSH deployment.

## Remaining dependency advisories

After updating dependencies, Composer reported no known advisories at the review time; npm reported four moderate advisories involving Tailwind 3, typography and nested PostCSS parsers. There were no npm high/critical advisories in the reviewed lock. They are build-tool dependencies, but still require remediation. Do not use `npm audit fix --force` without reviewing a Tailwind 4 migration and visual regressions. Audit results change over time.
