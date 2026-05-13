#!/bin/bash
# docker-start.sh - Quick Docker Setup for Burger Labs

echo "🍔 Starting Burger Labs (BLVWA) in Docker..."

# Check if docker-compose is installed
if ! command -v docker-compose &> /dev/null
then
    echo "❌ Error: docker-compose is not installed."
    exit 1
fi

# Deep clean to avoid common 'ContainerConfig' or port errors
echo "🧹 Cleaning old states..."
docker-compose down --rmi all &> /dev/null

# Build and start
echo "🚀 Building and launching containers..."
docker-compose up --build -d

echo "-------------------------------------------------------"
echo "✅ SUCCESS! Burger Labs is now running."
echo "🔗 Access URL: http://localhost:8000"
echo "🛠️ To stop the lab, run: docker-compose down"
echo "-------------------------------------------------------"
