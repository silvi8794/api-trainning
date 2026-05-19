<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymSystem | Dashboard Prémium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #050505;
            color: #e5e5e5;
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(168, 85, 247, 0.4);
            box-shadow: 0 10px 30px -10px rgba(168, 85, 247, 0.2);
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Sidebar / Nav -->
    <nav class="fixed top-0 left-0 h-full w-64 glass border-r border-white/5 p-6 hidden md:block">
        <div class="flex items-center gap-3 mb-12">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <i data-lucide="dumbbell" class="text-white w-6 h-6"></i>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Gym<span class="text-indigo-500">System</span></h1>
        </div>

        <ul class="space-y-4">
            <li>
                <a href="#" class="flex items-center gap-3 p-3 bg-indigo-600/10 text-indigo-400 rounded-xl border border-indigo-600/20">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:text-white transition-colors">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>Socios</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:text-white transition-colors">
                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                    <span>Pagos</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:text-white transition-colors">
                    <i data-lucide="calendar-check" class="w-5 h-5"></i>
                    <span>Asistencia</span>
                </a>
            </li>
        </ul>

        <div class="absolute bottom-8 left-6 right-6">
            <div class="p-4 glass rounded-2xl border border-white/5">
                <p class="text-xs text-gray-500 mb-1">Admin Mode</p>
                <p class="text-sm font-medium">Gestión de Gimnasio</p>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="md:ml-64 p-8 pt-24 md:pt-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold mb-2">Bienvenido, Admin</h2>
                <p class="text-gray-400">Aquí tienes el resumen de hoy, <span class="text-indigo-400">{{ date('d M, Y') }}</span></p>
            </div>
            <div class="flex gap-4">
                <button class="glass p-2 rounded-xl border border-white/10 relative">
                    <i data-lucide="bell" class="w-6 h-6 text-gray-400"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-600"></div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="glass p-6 rounded-3xl border border-white/5 card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-indigo-500/10 rounded-2xl">
                        <i data-lucide="users" class="w-6 h-6 text-indigo-500"></i>
                    </div>
                    <span class="text-xs text-green-500 bg-green-500/10 px-2 py-1 rounded-lg">+12%</span>
                </div>
                <h3 class="text-gray-400 text-sm font-medium mb-1">Total Alumnos</h3>
                <p class="text-3xl font-bold">142</p>
            </div>

            <div class="glass p-6 rounded-3xl border border-white/5 card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-emerald-500/10 rounded-2xl">
                        <i data-lucide="dollar-sign" class="w-6 h-6 text-emerald-500"></i>
                    </div>
                </div>
                <h3 class="text-gray-400 text-sm font-medium mb-1">Pagos este Mes</h3>
                <p class="text-3xl font-bold">$234,500</p>
            </div>

            <div class="glass p-6 rounded-3xl border border-white/5 card-hover transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-fuchsia-500/10 rounded-2xl">
                        <i data-lucide="check-circle" class="w-6 h-6 text-fuchsia-500"></i>
                    </div>
                </div>
                <h3 class="text-gray-400 text-sm font-medium mb-1">Asistencia Hoy</h3>
                <p class="text-3xl font-bold">34</p>
            </div>
        </div>

        <!-- Recent Activity & Debtors -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Debtors List -->
            <section class="glass p-8 rounded-[2rem] border border-white/5">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Alumnos con Deuda</h3>
                    <a href="#" class="text-sm text-indigo-400 hover:underline">Ver todos</a>
                </div>
                <div class="space-y-4">
                    <!-- Sample Item -->
                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center font-bold text-xs">JD</div>
                            <div>
                                <p class="font-medium">Juan Perez</p>
                                <p class="text-xs text-gray-501">DNI: 12.345.678</p>
                            </div>
                        </div>
                        <span class="text-red-400 text-sm font-semibold">Pendiente</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/5 text-gray-500">
                        <p class="text-sm italic">Ejemplo de vista previa...</p>
                    </div>
                </div>
            </section>

            <!-- Shortcuts -->
            <section class="space-y-6">
                <div class="glass p-8 rounded-[2rem] border border-white/5 bg-gradient-to-br from-indigo-600/10 to-transparent">
                    <h3 class="text-xl font-bold mb-4">Acciones Rápidas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <button class="p-4 bg-white/5 hover:bg-white/10 rounded-2xl transition-all text-left">
                            <i data-lucide="user-plus" class="w-6 h-6 mb-2 text-indigo-400"></i>
                            <p class="font-medium text-sm">Nuevo Socio</p>
                        </button>
                        <button class="p-4 bg-white/5 hover:bg-white/10 rounded-2xl transition-all text-left">
                            <i data-lucide="plus-circle" class="w-6 h-6 mb-2 text-indigo-400"></i>
                            <p class="font-medium text-sm">Registrar Pago</p>
                        </button>
                    </div>
                </div>

                <div class="glass p-8 rounded-[2rem] border border-white/5">
                    <h3 class="text-xl font-bold mb-4">Check-in de Asistencia</h3>
                    <div class="flex gap-2">
                        <input type="text" placeholder="DNI del Alumno..." class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 w-full focus:outline-none focus:border-indigo-500 transition-all">
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold transition-all">OK</button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
