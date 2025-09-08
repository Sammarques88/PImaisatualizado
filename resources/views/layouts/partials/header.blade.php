<link rel="stylesheet" href="{{ asset('CSS/styles-parciais.css')}}">
</head>
<body>
<header>
    <div class="interface">
        <section class="logo">
            <a href="{{ route('home') }}" class="logo">C<span>o</span>nexus</a>
        </section>

        <section class="menu-desktop">
            <nav>
                <ul class="links">
                    <li><a href="{{ route('perfil') }}">Meu Perfil</a></li>
                    <li><a href="{{ route('area-user') }}">Área de Usuário</a></li>
                    <li><a href="{{ route('sobre') }}">Sobre Nós</a></li>
                    <li><a href="#">Salas</a></li>
                </ul>
            </nav>
        </section>

        @auth
            <!-- Menu hambúrguer com foto -->
            <div class="menu-usuario">
                <img src="{{ Auth::user()->foto_perfil ? asset('storage/' . Auth::user()->foto_perfil) : asset('images/default-user.png') }}" 
                     alt="Foto de perfil" class="foto-perfil" onclick="toggleUserMenu()">
                <div id="userDropdown" class="dropdown-content">
                    <a href="{{ route('perfil') }}">Meu Perfil</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <section class="btn-contato">
                <a href="{{ route('cadastro.create') }}">
                    <button>Conecte-se</button>
                </a>
            </section>
        @endguest
    </div>

    <script>
        function toggleUserMenu() {
            document.getElementById('userDropdown').classList.toggle('show');
        }
        window.onclick = function(event) {
            if (!event.target.matches('.foto-perfil')) {
                let dropdowns = document.getElementsByClassName('dropdown-content');
                for (let i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].classList.remove('show');
                }
            }
        }
    </script>
</header>
<script src="{{ asset('JS/script.js') }}"></script>
</body>
