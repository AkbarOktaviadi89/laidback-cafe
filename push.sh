#!/bin/bash

# Script otomatis git add, commit, push
# Cara pakai: ./git-push.sh "pesan commit"

# Cek apakah ada pesan commit
if [ -z "$1" ]; then
  echo "⚠️  Harap masukkan pesan commit!"
  echo "Contoh: ./git-push.sh \"Update fitur checkout\""
  exit 1
fi

# Jalankan git commands
git add .
git commit -m "$1"
git push -u origin main
