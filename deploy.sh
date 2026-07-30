#!/bin/bash
echo "🚀 Duke përgatitur dërgimin e kodit..."

# 1. Shton të gjitha ndryshimet e reja
git add .

# 2. Bën commit me një mesazh automatik
git commit -m "Auto-update: Përditësim i skedarëve dhe konfigurimeve nga terminali"

# 3. I dërgon ndryshimet në GitHub (që aktivizon Render automatikisht)
git push origin main

echo "✅ Kodi u dërgua me sukses në GitHub! Render do të përditësohet tani."
