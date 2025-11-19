# Composer For cPanel - Complete Installation Guide

Composer is the most widely used dependency manager for PHP. Many frameworks and scripts (Laravel, Symfony, Magento, WordPress plugins, and more) rely on it.

If you are using cPanel hosting, installing Composer becomes very simple - but only if your hosting provider gives you Terminal (SSH) access.

This guide will walk you through all the available installation methods, requirements, and verification steps.

Let's begin!

## ✅ Requirements

Before installing Composer on cPanel, make sure the following conditions are met:

- **Terminal / SSH access** must be enabled on your cPanel account.
- **PHP** must be installed in your cPanel (all modern cPanel servers already have PHP available).
- **Git** should be enabled (only required for the Git installation method, not for the curl method).
- Works only on cPanel accounts with Terminal access.

## ✅ Installation Methods

You can install Composer in two ways:

1. Using the official PyNoxi automated Git repository installer
2. Using a single command via curl

Both methods install Composer directly in your cPanel user environment.

### 🧩 Method 1: Install Composer Using Git (Recommended)

This method installs Composer using the automated installer maintained by PyNoxi Web Solutions.

**Step 1 - Clone the Repository**
```bash
git clone https://github.com/pynoxi/Composer-For-cPanel
```

**Step 2 - Navigate into the directory**
```bash
cd Composer-For-cPanel
```

**Step 3 - Run the installer**
```bash
php installer.php
```

The script automatically:

- Downloads the latest Composer version
- Installs it inside your cPanel user directory
- Configures the environment
- Gives a clean success message once completed

### 🧩 Method 2: One-Line Installation (curl)

If you prefer the quick command method, just run:

```bash
curl -s https://raw.githubusercontent.com/pynoxi/Composer-For-cPanel/refs/heads/main/installer.php | php
```

This will download and directly execute the installer script inside your cPanel account.

## ✅ Verify the Installation

After installation, check if Composer is installed correctly by running:

```bash
composer -v
```

You should see output similar to:

```
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 2.9.1 2025-11-13 16:10:38
```

If this appears, Composer has been successfully installed on your cPanel account!

## 🎯 Conclusion

Installing Composer on cPanel is extremely easy with the right tools.

Whether you choose the Git installer or the single-command method, this guide ensures you get Composer running smoothly within minutes.

If SSH access is not available on your hosting, simply request your provider to enable it—or switch to a provider who supports it.

## 🚀 Looking for Reliable Web Hosting or Web Solutions?

If you need fast, secure, and feature-rich hosting with full SSH/Terminal support, check out [pynoxi.com](https://pynoxi.com)

Professional hosting, modern infrastructure, premium support.