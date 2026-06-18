# POTRZEBUJE.PL OPERATIONS GUIDE v1

## 1. PURPOSE

This document describes how the potrzebuje.pl ecosystem is operated, deployed, backed up, restored and maintained.

This document complements:

POTRZEBUJE.PL_MASTER_CONTEXT.md

MASTER_CONTEXT explains what the project is.

OPERATIONS explains how the project is managed.

---

# 2. ENVIRONMENT OVERVIEW

Main Production Website:

/home/potrzebuje/public_html

Main Git Repository:

/home/potrzebuje/Projects/GitHub_Repos/potrzebuje-pl

GitHub Repository:

https://github.com/TomKazPoland/potrzebuje-pl

Secrets:

/home/potrzebuje/Projects/Secrets

Server Only Assets:

/home/potrzebuje/Projects/Server_Only

Logs:

/home/potrzebuje/public_html/logs

---

# 3. HOSTING

Provider:

WEBMEDIA EUROPE LTD

Environment:

Shared Hosting

Control Panel:

cPanel

Web Server:

LiteSpeed

Python Support:

Passenger

Terminal:

cPanel Terminal

Important Limitations:

* no root access
* no direct server administration
* limited diagnostics
* limited SSH capabilities
* some issues require hosting provider support

---

# 4. DEPLOYMENT FLOW

Current deployment model:

Developer
→ GitHub
→ GitHub Actions
→ SFTP
→ Production

Repository:

TomKazPoland/potrzebuje-pl

Branch:

main

Workflow:

.github/workflows/deploy.yml

Important:

Production directory does not contain .git.

Production is deployment target only.

GitHub remains source of truth.

---

# 5. GITHUB STRUCTURE

Main Website:

TomKazPoland/potrzebuje-pl

Additional Projects:

TomKazPoland/alpha_analyzer

TomKazPoland/app_anonymous

Local Repository Clones:

/home/potrzebuje/Projects/GitHub_Repos

---

# 6. OPENAI OPERATIONS

Current Provider:

OpenAI

Current Model:

gpt-4o-mini

Production Secret:

/home/potrzebuje/Projects/Secrets/chatgpt.php

Important Rules:

* never expose API key
* never commit API key
* never move secrets into public_html
* use single source of truth

---

# 7. LOGGING

Main Logs:

/home/potrzebuje/public_html/logs

Input Logs:

demo_user_inputs.log

Operational Logs:

deployment logs
diagnostic logs
application logs

Rule:

Never log secrets.

---

# 8. BACKUP STRATEGY

Critical Assets:

1. Domain configuration
2. Hosting account
3. GitHub repositories
4. OpenAI configuration
5. Email accounts
6. Databases
7. Documentation
8. Historical backups

Production Backup Sources:

GitHub repositories

Server backups

ZIP archives

Database copies

Documentation

---

# 9. RESTORE STRATEGY

Restore Order:

Step 1:
Recover hosting access.

Step 2:
Recover domain configuration.

Step 3:
Recover GitHub repositories.

Step 4:
Recover Secrets directory.

Step 5:
Recover production databases.

Step 6:
Deploy applications.

Step 7:
Validate functionality.

Step 8:
Validate OpenAI integration.

Step 9:
Validate contact forms.

Step 10:
Validate logs and monitoring.

---

# 10. APPLICATION INVENTORY

Primary Application:

potrzebuje.pl

Purpose:

Business website.

Status:

Production.

---

Additional Application:

Alpha Analyzer

Purpose:

Investment analytics platform.

Status:

Operational.

---

Additional Application:

Anonymous

Purpose:

Anonymization benchmark platform.

Status:

Operational.

---

# 11. KNOWN LIMITATIONS

Shared hosting environment.

No root access.

No direct infrastructure control.

Production troubleshooting may require hosting provider involvement.

No Git repository inside production public_html.

Some diagnostics are restricted by cPanel environment.

---

# 12. CHANGE MANAGEMENT

Before major changes:

1. Create backup.
2. Verify rollback path.
3. Verify deployment path.
4. Verify secrets handling.
5. Verify database impact.

After changes:

1. Verify application.
2. Verify logs.
3. Verify OpenAI integration.
4. Verify contact functionality.
5. Verify deployment state.

---

# 13. SURE METHODOLOGY

All future work should follow:

DIAG
→ ROOT CAUSE
→ PATCH

Rules:

* no guessing
* verify runtime
* verify production state
* rollback ready
* minimal change principle
* validate side effects

---

# 14. FUTURE OPERATIONS IMPROVEMENTS

Potential future improvements:

* hosting migration
* automated backup inventory
* centralized documentation
* deployment validation scripts
* monitoring improvements
* disaster recovery testing

---

# 15. EMERGENCY RECOVERY CHECKLIST

If production fails:

1. Verify hosting status.
2. Verify domain resolution.
3. Verify cPanel access.
4. Verify GitHub access.
5. Verify Secrets directory.
6. Verify databases.
7. Verify deployment workflow.
8. Verify OpenAI integration.
9. Verify logs.
10. Verify business-critical pages.

Success criteria:

Website operational.
AI Demo operational.
Contact operational.
Applications accessible.
Logs functioning.
Documentation available.

