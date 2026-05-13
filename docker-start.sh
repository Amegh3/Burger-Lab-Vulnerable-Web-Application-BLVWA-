#!/bin/bash
# docker-start.sh - Professional Docker Setup for Burger Labs

echo "🍔 Starting Burger Labs (BLVWA) Deployment..."

# 0. Sync Latest Code
if [ -d ".git" ]; then
    echo "🔄 Pulling latest updates from GitHub..."
    git pull origin main
fi

# 1. Detect Docker Compose (Support both V1 and V2)
DOCKER_COMPOSE_CMD=""
if command -v docker-compose &> /dev/null; then
    DOCKER_COMPOSE_CMD="docker-compose"
elif docker compose version &> /dev/null; then
    DOCKER_COMPOSE_CMD="docker compose"
else
    echo "❌ Error: Docker Compose not found. Please install Docker Compose (V1 or V2)."
    exit 1
fi

echo "✅ Using $DOCKER_COMPOSE_CMD"

# 2. Deep Clean Environment
echo "🧹 Purging old containers, volumes, and cached images..."
$DOCKER_COMPOSE_CMD down --volumes --rmi all &> /dev/null

# 3. Build and Launch
echo "🚀 Building fresh environment from source..."
$DOCKER_COMPOSE_CMD up --build -d

echo "-------------------------------------------------------"
echo "✅ SUCCESS! Burger Labs Production Model is now running."
echo "🔗 Access URL: http://localhost:8000"
echo "🛠️ To stop the lab, run: $DOCKER_COMPOSE_CMD down"
echo "-------------------------------------------------------"
