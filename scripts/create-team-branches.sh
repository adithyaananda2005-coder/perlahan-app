#!/usr/bin/env bash
set -euo pipefail
if ! git diff --quiet || ! git diff --cached --quiet; then echo 'ERROR: working tree tidak bersih. Commit/stash dulu.'; exit 1; fi
if [[ "$(git branch --show-current)" != "main" ]]; then echo 'ERROR: jalankan dari branch main.'; exit 1; fi
branches=("frontend/jingga" "frontend/citra" "backend/adithya" "backend/fadhil" "database/schema")
for branch in "${branches[@]}"; do if git show-ref --verify --quiet "refs/heads/$branch"; then echo "ERROR: branch $branch sudah ada; tidak diubah."; exit 1; fi; done
base="$(git rev-parse main)"
for branch in "${branches[@]}"; do git branch "$branch" "$base"; echo "Created $branch from $base"; done
echo 'Semua branch berasal dari commit baseline main yang sama. Belum ada merge.'
