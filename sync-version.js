#!/usr/bin/env node

/**
 * Syncs version number between package.json and WordPress theme header (style.css)
 * Usage: node sync-version.js
 */

import { readFileSync, writeFileSync } from 'fs';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

// Read package.json
const packagePath = join(__dirname, 'package.json');
const packageJson = JSON.parse(readFileSync(packagePath, 'utf8'));
const version = packageJson.version;

console.log(`📦 Package version: ${version}`);

// Update style.css (WordPress theme header)
const stylePath = join(__dirname, 'style.css');
let styleContent = readFileSync(stylePath, 'utf8');

// Replace version in WordPress theme header
const versionRegex = /^Version:\s*(.+)$/m;
const match = styleContent.match(versionRegex);

if (match) {
  const oldVersion = match[1].trim();
  if (oldVersion !== version) {
    styleContent = styleContent.replace(versionRegex, `Version: ${version}`);
    writeFileSync(stylePath, styleContent);
    console.log(`✅ Updated style.css: ${oldVersion} → ${version}`);
  } else {
    console.log(`✅ style.css already at version ${version}`);
  }
} else {
  console.error('❌ Could not find Version line in style.css');
  process.exit(1);
}

console.log('✨ Version sync complete!');
