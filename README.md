Publishing House Management Platform

**Tech Stack**
- Laravel
- Laravel Fortify
- Spatie Permissions
- MariaDB
- Blade + Alpine.js
- Tailwind CSS

**Core Features**

**Authentication & Security**
- Custom Laravel Fortify integration
- Email verification & password reset
- Registration & password reset throttling
- Protection against user enumeration
- Client + server-side validation
- Role-based redirection
- Signed account restore links (14-day grace period)
- Scheduled hard deletion of soft-deleted users

**Role-Based Access Control**
- Roles & permissions via Spatie
- Admin, Publisher, Author, Reader roles
- Role-protected dashboards
- Database seeders for roles and initial admin

**Account Lifecycle Design**
- Soft deletes with cascading behavior via model observers
- Restore flow via signed email link
- Scheduled purge command for permanent deletion

**Multilingual Support (English / Arabic)**
- Locale stored in database
- Middleware-based locale resolution (user -> cookie -> browser preference -> fallback)
- Full UI + emails translations
- RTL / LTR handling
- Pluralization support

**Domain Modeling & Data Integrity**
- Refactored Book -> Edition -> EditionFormat structure
- Database-level unique constraints
- Cascading soft deletes
- Slug-based routing for SEO-friendly URLs
- Computed model accessors
- Clean factory & seeder design respecting constraints

**UI / UX Enhancements**
- Dark mode & theme switching
- Avatar upload & cropping
- Custom Blade components
- Responsive layout


**Screenshots**

![singup](https://github.com/user-attachments/assets/4090ad70-72e5-4016-a488-c3efeb1989c9)

![verification](https://github.com/user-attachments/assets/d9fee5fc-3611-49f7-bec9-85ad2daff092)

![email-verification](https://github.com/user-attachments/assets/f6c1be67-29e3-4cd8-822c-7a2ae863dec1)

![login](https://github.com/user-attachments/assets/c3ed7d21-b6e1-49d0-8c4c-097522be3e20)

![books](https://github.com/user-attachments/assets/874b274d-1b9b-4974-a7eb-737018f95c65)

![authors](https://github.com/user-attachments/assets/dd0f4243-3738-415c-afab-586c4b6b4430)

![settings](https://github.com/user-attachments/assets/50878cb1-9312-4c43-a8a8-3f7790a022be)

![delete-account](https://github.com/user-attachments/assets/73f4ec55-3d29-47eb-9767-0dafc6aa3060)
