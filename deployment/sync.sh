#!/usr/bin/env bash
set -euo pipefail

ENV_FILE="${1:-deployment/env}"

if ! command -v gh >/dev/null 2>&1; then
    echo "GitHub CLI (gh) is required."
    exit 1
fi

if [ ! -f "$ENV_FILE" ]; then
    echo "Env file not found: $ENV_FILE"
    exit 1
fi

set -a
# shellcheck disable=SC1090
source "$ENV_FILE"
set +a

: "${DEPLOY_PATH:?DEPLOY_PATH is required}"
: "${DEPLOY_BRANCH:?DEPLOY_BRANCH is required}"
: "${SSH_HOST:?SSH_HOST is required}"
: "${SSH_PORT:?SSH_PORT is required}"
: "${SSH_USER:?SSH_USER is required}"
: "${SSH_PRIVATE_KEY:?SSH_PRIVATE_KEY is required}"

decode_newlines() {
    printf '%b' "$1"
}

gh variable set DEPLOY_PATH --body "$DEPLOY_PATH"
gh variable set DEPLOY_BRANCH --body "$DEPLOY_BRANCH"
gh variable set SSH_HOST --body "$SSH_HOST"
gh variable set SSH_PORT --body "$SSH_PORT"
gh variable set SSH_USER --body "$SSH_USER"

decode_newlines "$SSH_PRIVATE_KEY" | gh secret set SSH_PRIVATE_KEY

echo "GitHub Actions variables and secrets synced."
