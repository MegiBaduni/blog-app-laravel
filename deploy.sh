#!/bin/bash
echo "🚀 Duke përgatitur përditësimin..."

# 1. Shton të gjitha ndryshimet
git add .

# 2. Pyet për mesazhin e commit-it ose përdor një standard
git commit -m "Auto-update: përditësim i skedarëve dhe konfigurimeve"

# 3. I dërgon në GitHub
git push origin main

echo "✅ Kodi u dërgua me sukses në GitHub! Render do të nisë ndërtimin automatikisht."
