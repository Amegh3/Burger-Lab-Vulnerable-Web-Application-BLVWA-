#!/bin/bash

# Burger Lab Vulnerable Web Application (BLVWA) - Automated Server Setup
# Target OS: Ubuntu 20.04 / 22.04 LTS

echo "🍔 Starting BLVWA Automated Deployment..."

# 1. Update System
sudo apt-get update -y
sudo apt-get upgrade -y

# 2. Install LAMP Stack
echo "📦 Installing Apache, MySQL, and PHP..."
sudo apt-get install -y apache2 mysql-server php libapache2-mod-php php-mysql git curl php-xml php-mbstring

# 3. Configure MySQL
echo "🗄️ Configuring Database..."
DB_NAME="burger_db"
DB_USER="burger_user"
DB_PASS="BurgerPassword123!"

sudo mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
sudo mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
sudo mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 4. Clone Repository (if not already present)
if [ ! -d "/var/www/blvwa" ]; then
    echo "📥 Cloning BLVWA Repository..."
    sudo git clone https://github.com/Amegh3/Burger-Lab-Vulnerable-Web-Application-BLVWA-.git /var/www/blvwa
else
    echo "🔄 Updating BLVWA Repository..."
    cd /var/www/blvwa && sudo git pull origin main
fi

# 5. Import Database Schema
if [ -f "/var/www/blvwa/database/schema.sql" ]; then
    echo "🔌 Importing Database Schema..."
    sudo mysql ${DB_NAME} < /var/www/blvwa/database/schema.sql
fi

# 6. Configure Apache VirtualHost
echo "🌐 Configuring Apache VirtualHost..."
sudo tee /etc/apache2/sites-available/blvwa.conf > /dev/null <<EOF
<VirtualHost *:80>
    ServerAdmin admin@burgerlabs.htb
    DocumentRoot /var/www/blvwa/public
    
    <Directory /var/www/blvwa/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# 7. Enable Site and Rewrite Module
sudo a2dissite 000-default.conf
sudo a2ensite blvwa.conf
sudo a2enmod rewrite
sudo systemctl restart apache2

# 8. Set Permissions
echo "🔐 Setting Permissions..."
sudo chown -R www-data:www-data /var/www/blvwa
sudo chmod -R 755 /var/www/blvwa

echo "✅ BLVWA Deployment Complete!"
echo "📍 Access your lab at: http://$(curl -s ifconfig.me)"
echo "🚀 Happy Hacking!"
