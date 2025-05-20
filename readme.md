# CoffeeMachine ☕

**CoffeeMachine** to przykładowy projekt w języku PHP symulujący działanie ekspresu do kawy. Został stworzony w celu nauki programowania obiektowego, testów jednostkowych i organizacji kodu w praktycznym, ale prostym scenariuszu.

## Funkcje
- Obsługa przygotowywania różnych rodzajów kawy (np. espresso, cappuccino – w zależności od implementacji).
- Zarządzanie stanem zasobników (woda, kawa, mleko).
- Komunikaty o błędach i brakujących składnikach.
- Modułowa budowa – łatwa rozbudowa o nowe funkcje.
- Pokrycie testami jednostkowymi przy użyciu **PHPUnit**.

## Struktura projektu
<pre>
CoffeeMachine/
├── src/          # Kod źródłowy aplikacji
├── tests/        # Testy jednostkowe
├── vendor/       # Zewnętrzne zależności (zarządzane przez Composer)
├── index.php     # Plik startowy (demo lub punkt wejścia)
├── composer.json # Definicja zależności i autoloadingu
</pre>

## Wymagania
- PHP 8.x
- Composer

## Instalacja
```bash
git clone https://github.com/twoja-nazwa-uzytkownika/CoffeeMachine.git
cd CoffeeMachine
composer install
```

## Licencja

Projekt udostępniony na licencji MIT.
