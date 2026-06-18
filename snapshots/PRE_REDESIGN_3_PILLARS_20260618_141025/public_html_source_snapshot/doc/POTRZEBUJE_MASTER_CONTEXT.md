# POTRZEBUJE.PL MASTER CONTEXT 

## 1. PROJECT IDENTITY

Project Name:
potrzebuje.pl

Project Type:
AI consulting, training, transformation and software development business website.

Primary Goal:
Acquire first paying customers and obtain first customer references.

Current Stage:
Working website, pre-commercial growth stage.

Project Owner:
Tomasz

---

## 2. BUSINESS PURPOSE

Potrzebuje.pl exists to help organizations and professionals adopt Artificial Intelligence in practical business environments.

The project is built around three strategic service pillars:

### Pillar A — AI Education & Training

Services:

* AI fundamentals
* Prompt engineering
* AI tools
* Practical AI adoption
* Remote training

Target Groups:

* managers
* accountants
* engineers
* developers
* SMEs
* business professionals

### Pillar B — AI Transformation & Process Improvement

Services:

* process discovery
* process analysis
* process redesign
* automation identification
* AI integration
* implementation planning

### Pillar C — Software Development

Services:

* custom applications
* AI-assisted development
* internal tools
* automation solutions
* software supporting transformation projects

Important:
Clients may enter through any pillar.
There is no mandatory sequence between training, transformation and software development.

---

## 3. CURRENT BUSINESS OBJECTIVES

Primary KPI:
First paying customer.

Secondary KPI:
First customer references.

12-Month Objectives:

* acquire first customers
* obtain references
* expand portfolio
* demonstrate AI capabilities
* grow transformation offerings
* grow software-development offerings

Future Scaling:
Only after obtaining successful customer references.

---

## 4. TARGET AUDIENCE

Primary:

* managers
* accountants
* engineers
* developers
* SMEs
* professionals interested in AI adoption

Secondary:

* companies seeking AI transformation
* organizations requiring custom software solutions

---

## 5. MAIN WEBSITE

Production Path:

/home/potrzebuje/public_html

Main Files:

index.php
nav.php
contact.php
config.php
demo_api.php

Languages:

* Polish
* English
* German

Language Directories:

/en
/de

Purpose:

* business presentation
* service presentation
* lead generation
* contact channel
* AI capability showcase

---

## 6. HOSTING

Hosting Provider:

WEBMEDIA EUROPE LTD

Environment:

Shared hosting

Management:

cPanel

Web Server:

LiteSpeed

Important Limitation:

No root access.

No full server control.

Terminal access only through cPanel Terminal.

Some diagnostics require hosting provider support.

---

## 7. GITHUB

Main Repository:

https://github.com/TomKazPoland/potrzebuje-pl

Branch:

main

Local Repository Clone:

/home/potrzebuje/Projects/GitHub_Repos/potrzebuje-pl

Production Directory:

/home/potrzebuje/public_html

Important:

Production directory is NOT a Git checkout.

---

## 8. DEPLOYMENT

Current Deployment Model:

GitHub
→ GitHub Actions
→ SFTP
→ public_html

Workflow:

.github/workflows/deploy.yml

Important:

public_html does not contain .git.

GitHub is the source of truth.

---

## 9. OPENAI / AI DEMO

Provider:

OpenAI

Current Model:

gpt-4o-mini

Production Secret Location:

/home/potrzebuje/Projects/Secrets/chatgpt.php

Rules:

* secrets outside public_html
* secrets never committed to repositories
* single source of truth
* controlled usage

AI Demo Flow:

User
→ demo_api.php
→ config.php
→ chatgpt.php
→ OpenAI
→ JSON response

---

## 10. AI DEMO LIMITS

Current Limits:

Input:
20 words

Output:
100 words

Daily Requests:
100 per IP

Translations:
10

Allowed Languages:
pl
en
de

Blocked Topics:

* medical
* legal
* financial advice
* illegal activities
* political content
* erotic content

---

## 11. SECURITY MODEL

Core Principles:

* secrets outside public_html
* GitHub without secrets
* OpenAI credentials isolated
* deployment through GitHub Actions
* logging without secrets

Secrets Location:

/home/potrzebuje/Projects/Secrets

Current Secret File:

chatgpt.php

---

## 12. LOGGING

Main Logs:

/home/potrzebuje/public_html/logs

AI Demo Input Log:

demo_user_inputs.log

Additional Logs:
deployment
diagnostics
application logs

---

## 13. ADDITIONAL APPLICATIONS

The following applications are intentionally separated from the main website.

They are demonstrations of capabilities rather than core business systems.

### Alpha Analyzer

Purpose:
Investment and fund analysis platform.

Technology:
Flask
SQLite
OpenAI

Repository:
Dedicated repository.

Database:
alpha_analyzer.db

Status:
Operational.

### Anonymous

Purpose:
Anonymization benchmark and analysis platform.

Technology:
Python
SQLite

Repository:
TomKazPoland/app_anonymous

Database:
mapping.db

Status:
Operational.

---

## 14. DIRECTORY STRUCTURE

Main Website:

/home/potrzebuje/public_html

Applications:

/home/potrzebuje/Projects/alpha_analyzer
/home/potrzebuje/Projects/anonymous_app

Repositories:

/home/potrzebuje/Projects/GitHub_Repos

Secrets:

/home/potrzebuje/Projects/Secrets

Server Only Assets:

/home/potrzebuje/Projects/Server_Only

---

## 15. DATABASES

Alpha Analyzer:

alpha_analyzer.db

Anonymous:

mapping.db

Important:

Databases are production assets and must be included in backup strategy.

---

## 16. OWNERSHIP

Controlled Directly By Project Owner:

* domain
* GitHub
* OpenAI account
* project email accounts

Hosting:

Managed service provided by WEBMEDIA EUROPE LTD.

---

## 17. RECOVERY PHILOSOPHY

All critical assets are considered equally important:

* domain
* hosting
* GitHub repositories
* OpenAI configuration
* email accounts
* production databases
* documentation
* backups

Recovery planning assumes full-environment restoration.

---

## 18. ARCHITECTURAL PRINCIPLES

Do not change without strong justification:

1. Secrets outside public_html.
2. Separation of demo applications from main website.
3. GitHub as source of truth.
4. Deployment through GitHub Actions.
5. Production environment isolated from repositories.

Allowed Future Changes:

* hosting migration
* OpenAI provider replacement
* deployment improvements

---

## 19. ROADMAP

Current Focus:

1. First paying customers.
2. First references.
3. Portfolio expansion.

Future Focus:

1. AI Training.
2. AI Transformation.
3. Software Development.

Website Evolution:

The website should gradually reflect all three business pillars more clearly.

---

## 20. QUICK START FOR NEW CHATGPT THREAD

Before proposing changes:

1. Understand that potrzebuje.pl is the primary project.
2. Alpha Analyzer and Anonymous are supporting demonstration applications.
3. Use SURE methodology.
4. Validate against production state.
5. Assume shared-hosting limitations.
6. Preserve secrets isolation.
7. Preserve GitHub deployment flow.
8. Prioritize customer acquisition and references.
9. Respect three service pillars:

   * AI Training
   * AI Transformation
   * Software Development
10. Never assume undocumented infrastructure.

