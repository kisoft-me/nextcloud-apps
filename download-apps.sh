#!/bin/bash
# ---------------------------------------------------------------------------
# install-apps.sh — run at Docker build time (not inside a live container)
#
# Downloads third-party Nextcloud apps into /usr/src/nextcloud/custom_apps/.
# The base image entrypoint copies that directory to /var/www/html/custom_apps/
# on first container start, making apps available to all tenants without
# touching the runtime named volume during the build.
#
# Core apps already shipped in /usr/src/nextcloud/apps/ (no download needed):
#   user_ldap, files_external, spreed, circles, contacts, tasks, theming,
#   twofactor_totp, twofactor_backupcodes
#
# These are enabled per-tenant by new-site, not installed here.
# ---------------------------------------------------------------------------
set -euo pipefail

DEST="./custom_apps"
mkdir -p $DEST
# ---------------------------------------------------------------------------
# install_remote_app <url>
#
# Downloads a tar.gz package from a URL and installs it to nextcloud
# ---------------------------------------------------------------------------
install_remote_app() {
    local URL="$1"

    echo "==> Installing from ${URL}"
    curl -fsSL "$URL" | tar -xz -C "$DEST"
    echo "    OK: ${URL}"
}

# ---------------------------------------------------------------------------
# Third-party apps — downloaded from GitHub releases
# ---------------------------------------------------------------------------

# Nextcloud Mail — IMAP/SMTP client with auto-provisioning support
install_remote_app https://github.com/nextcloud-releases/mail/releases/download/v5.7.3/mail-v5.7.3.tar.gz

# Calendar — CalDAV calendar
install_remote_app https://github.com/nextcloud-releases/calendar/releases/download/v6.2.1/calendar-v6.2.1.tar.gz

# Richdocuments — Collabora Online / WOPI integration
install_remote_app https://github.com/nextcloud-releases/richdocuments/releases/download/v10.1.0/richdocuments-v10.1.0.tar.gz

# Notes — plain-text / Markdown notes
install_remote_app https://github.com/nextcloud-releases/notes/releases/download/v4.13.0/notes-v4.13.0.tar.gz

# Deck — Kanban board
install_remote_app https://github.com/nextcloud-releases/deck/releases/download/v1.17.0/deck-v1.17.0.tar.gz

# Tables — structured data / spreadsheet-like tables
install_remote_app https://github.com/nextcloud-releases/tables/releases/download/v2.0.1/tables-v2.0.1.tar.gz

# OIDC Provider — makes this Nextcloud instance an OIDC identity provider
install_remote_app https://github.com/nextcloud-releases/user_oidc/releases/download/v8.6.1/user_oidc-v8.6.1.tar.gz

# Whiteboard — collaborative whiteboard
install_remote_app https://github.com/nextcloud-releases/whiteboard/releases/download/v1.5.7/whiteboard-v1.5.7.tar.gz

# Group Folders — shared folders owned by a group rather than a user
install_remote_app https://github.com/nextcloud-releases/groupfolders/releases/download/v21.0.6/groupfolders-v21.0.6.tar.gz

# Polls — Doodle-style scheduling polls
install_remote_app https://github.com/nextcloud-releases/polls/releases/download/v8.6.3/polls-8.6.3.tar.gz

# Passwords — team credential/password manager
install_remote_app https://git.mdns.eu/api/v4/projects/45/packages/generic/passwords/2026.2.0/passwords.tar.gz

# Preview Generator — background pre-generation of file thumbnails.
# Prevents latency spikes when users open folders for the first time.
# Runs via cron (occ preview:generate-all --batch-size=200).
install_remote_app https://github.com/nextcloud-releases/previewgenerator/releases/download/v5.13.0/previewgenerator-v5.13.0.tar.gz

# Full-text search core — provider-agnostic search framework
install_remote_app https://github.com/nextcloud-releases/fulltextsearch/releases/download/33.0.0/fulltextsearch-33.0.0.tar.gz

# Elasticsearch provider for full-text search
install_remote_app https://github.com/nextcloud-releases/fulltextsearch_elasticsearch/releases/download/33.0.0/fulltextsearch_elasticsearch-33.0.0.tar.gz

# Files FTS — indexes file content via fulltextsearch
install_remote_app https://github.com/nextcloud-releases/files_fulltextsearch/releases/download/33.0.0/files_fulltextsearch-33.0.0.tar.gz

# Spreed - For talk server
install_remote_app https://github.com/nextcloud-releases/spreed/releases/download/v23.0.2/spreed-v23.0.2.tar.gz

# Unrounded corners for styling
install_remote_app https://github.com/OliverParoczai/nextcloud-unroundedcorners/releases/download/v1.1.5/unroundedcorners-v1.1.5.tar.gz

# Contacts app - for managing contacts
install_remote_app https://github.com/nextcloud-releases/contacts/releases/download/v8.4.4/contacts-v8.4.4.tar.gz

# ---------------------------------------------------------------------------
# Fix ownership — www-data needs read access at runtime
# ---------------------------------------------------------------------------

echo ""
echo "==> All apps installed to ${DEST}"
ls -1 "$DEST"

