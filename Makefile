.PHONY: install serve build reset clean

install:
	@echo "📦 Installation du projet Laravel..."
	@composer install --no-interaction --prefer-dist
	@if [ ! -f .env ]; then cp .env.example .env; fi
	@php artisan key:generate --force
	@mkdir -p storage/framework/{sessions,views,cache/data} bootstrap/cache
	@chmod -R 775 storage bootstrap/cache || true
	@if [ ! -f database/database.sqlite ]; then touch database/database.sqlite; fi
	@php artisan migrate --seed --force
	@npm install
	@npm run build
	@echo "✅ Installation terminée avec succès."

serve:
	@echo "🚀 Lancement du serveur Laravel..."
	@php artisan serve & npm run dev

build:
	@echo "🧱 Compilation des assets front..."
	@npm run build

reset:
	@echo "♻️ Réinitialisation de la base SQLite..."
	@rm -f database/database.sqlite
	@touch database/database.sqlite
	@php artisan migrate --seed --force
	@echo "✅ Base de données recréée et seedée."

clean:
	@echo "🧹 Nettoyage des caches Laravel..."
	@php artisan optimize:clear
	@php artisan cache:clear
	@php artisan config:clear
	@php artisan route:clear
	@php artisan view:clear
