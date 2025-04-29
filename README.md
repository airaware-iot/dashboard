# AirAware web application
The AirAware web application is the center of the entire AirAware system. Written in PHP 8.3 using Laravel 12 and Livewire + TailwindCSS, it is using the latest technologies for blazing fast performance, even on super low power devices like the Raspberry Pi 3 it has been designed for.

## Frotnend
The frontend is built using Livewire and TailwindCSS, allowing for single page application behaviour using exclusively PHP. It allows for automatic polling of new data, ensuring youi always see the latest information. It also makes the app very smooth to use, as loading is at a minimum thanks to asynchronous requests.

## Backend
The backend is using the powerful Laravel framework, ensuring reliability and blazing fast performance. The app is designed to be easily extendable, having a single configuration file `app\enums\SensorDataTypes.php`, which houses all the settings for the allowed data types, such as recommended values, units, colors, etc. Everything is built using components, so adding a new Chart widget in `resources/views/dashboard.blade.php` is a breeze, just include the component and set the data type you want to see.

## Web server
The web server uses the built in artisan serve command, which is running using the pm2 process manager. While serve is not great for large scale applications, it is very small and lightweight and therefore perfect for a small computer such as the Pi. There is, however, also a provideed Docker image for running on more powerful Pis or other computers.

## Data storage
The app handles data storage efficiently using an sqlite database. Sensors send their data through NodeRED into an API endpoint, which then parses the data, labels, computes and stores it into a digestable form for the user to view.

## Information
All code is provided freely as permitted by the MIT license.
