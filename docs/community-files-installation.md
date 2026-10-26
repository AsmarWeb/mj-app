# Installing the murwaj community files

## Package scope

This package contains 13 repository files plus this installation guide. It is documentation only: no workflows, application code, environment files, keys or migrations are changed.

The complete README preserves technical instructions from the current `fix/catalog-api` branch. Its linked technical docs must come from the project, not from this archive. Apply on top of that development branch or after the stacked changes have been merged.

## Apply locally

1. Confirm the repository is `AsmarWeb/murwaj` and inspect `git status --short` in your existing `$HOME/mj-app`.
2. Preserve any uncommitted work. Do not overwrite locally edited documentation.
3. Create a documentation branch from the integrated development code (currently `fix/catalog-api`).
4. Copy the 13 repository files from this package to the matching paths. Merge any overlapping edits manually. Do not copy this guide unless you want it in the repo.
5. Review `git diff` and `git diff --check`.
6. Commit only the listed documentation/template paths and open a pull request.

No installation, key generation, database operation, dependency update or deployment is needed to apply this package. The README includes separate fresh-install commands for future developers; do not run them against an existing installation just to update documentation.

## Maintainer setup

- Enable GitHub private vulnerability reporting if appropriate; SECURITY.md does not enable it automatically. Until a private channel is available, reporters should not publish exploit details.
- Publish a private conduct-reporting contact method on the maintainer profile. The code of conduct does not invent an inbox.
- The MIT license follows the declaration in composer.json and the Raslo license. Preserve third-party notices; the license file does not relicense third-party assets or customer content.
- The active main ruleset has an empty required-check list as of 2026-10-26. Select the actual checks: `php (sqlite)`, `php (mysql)`, `frontend (ubuntu-latest)`, `frontend (macos-15-intel)`.
- Review roadmap/changelog statements when PRs merge or a release is approved.
- GitHub's community links and forms appear on the default branch after the documentation PR is merged. These files are not a customer privacy policy or terms of service.

## بالعربية

طبّق الملفات في فرع توثيق مبني على آخر تغييرات التطوير، ثم راجع الفروقات وافتح طلب دمج. لا تحتاج إلى تشغيل migrations أو تغيير .env أو APP_KEY. فعّل قناة بلاغات أمان خاصة وحدّد وسيلة خاصة لشكاوى السلوك قبل الاعتماد على تلك السياسات. راجع الملفات الحالية قبل الاستبدال.
