<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/nav.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/comentarios.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Comentarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css" />
</head>

<body>


   

    @include('partials.navbar')

    <main>
        <div class="container">
        <div class="left">
            <div class="sidebar">

            <a href="{{ Route('home')}}" class="menu-item active">
                <span><i class="uil uil-home"></i></span> <h3>Home</h3>
            </a>
            <a class="menu-item ">
                <span><i class="uil uil-bell"></i></span> <h3>Notificações</h3>
            </a>

            <a href="{{ Route('postagens')}}" class="menu-item">
                <span><i class="uil uil-question-circle"></i></span> <h3>Postagens</h3>
            </a>
            <a class="menu-item " href="{{Route('chat.list')}}">
                <span><i class="uil uil-chat"></i></span> <h3>Chat</h3>
            </a>
            <a href="{{ Route('perfil')}}" class="menu-item ">
                <span><i class="uil uil-edit-alt"></i></span> <h3>Perfil</h3>
            </a>


            </div>
        </div>


            @php
            $coresModulo = [
            '1º' => 'red',
            '2º' => 'blue',
             '3º' => 'green',       
            ];
            @endphp



            <div class="meio">

                <div class="feeds">
                    <div class="feed">

                              
                    <div class="user">
                             <div class="profileImg">
                                 <img src="{{ asset('storage/' . $post->user->urlDaFoto) }}" alt="">
                             </div>
                             <div class="info">
                                <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; widht:100%">
                                    <h3>{{ $post->user->name }}</h3>
                                 <div class="modulo-div" style="background-color: {{ $coresModulo[$post->user->modulo] ?? 'defaultColor' }};">
                                    <p>{{ $post->user->modulo }} {{ $post->user->perfil }}</p>
                                </div>
                                
                                 </div>
                                     <p>{{ $post->user->perfil }}</p>
                                     
                                 </div>
                                 
                                 
                                
                         </div>

                         <div class="tipoCont">
                            <div class="tipo-div">
                                <p>{{ $post->tipo_post }}</p>
                            </div>
                        </div>
                        <div class="textoPost">
                            {{ $post->texto }}
                        </div>

                        <div class="imgPost">
                            <a href="{{ asset('storage/' . $post->fotoPost) }}" data-lightbox="gallery" data-title="Descrição da imagem">
                                <img src="{{ asset('storage/' . $post->fotoPost) }}" alt="" style="max-width: 100%; height: auto;">
                            </a>
                        </div>

                        <div class="action-button">
                            <div class="interaction-button">
                                <span><i class="uil uil-thumbs-up"></i></span>
                                <span><i class="uil uil-comment"></i></span>
                            </div>
                            <div class="bookmark">
                                <span><i class="uil uil-bookmark"></i></span>
                            </div>
                        </div>
                            <div class="headerComentarios">
                                @csrf


                               

                                <div class="dataFiltro">
                                <form method="GET" action="{{ route('comentarios.show', ['id' => $post->id]) }}">
                                    <select name="sortOrder" onchange="this.form.submit()">
                                        <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>Mais recente</option>
                                        <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>Mais antigo</option>
                                    </select>
                                </form>
                            </div>
                           

                        </div>

                            <form action="{{ route('comentarios.store', $post->id) }}" method="POST" class="criarPost">
                                @csrf
                            <div class="filtroComentarios">
                            <textarea name="texto" placeholder="Responda..." required></textarea>
                            <button type="submit" class="postarBotao" data-bs-toggle="modal" data-bs-target="#modalPost"> Enviar
                            
                            </div>


                        </form>


                        <div id="comentariosSection">
                            @foreach($comentarios as $comentario)
                            <div class="comentarioContainer">
                                <div class="user" style="align-items: center;">
                                    <div class="profileImg" style="width: 50px; height: 50px;">
                                        <img src="{{ asset('storage/' . $comentario->user->urlDaFoto) }}" alt="{{ $comentario->user->name }}">
                                    </div>
                                    <div class="info">
                                <div class="infoHeader" style="display:flex; align-items:center; justify-content:space-between; widht:100%">
                                    <h3>{{ $comentario->user->name }}</h3>
                                 <div class="modulo-div" style="background-color: {{ $coresModulo[$comentario->user->modulo] ?? 'defaultColor' }};">
                                    <p>{{ $comentario->user->modulo }} {{ $post->user->perfil }}</p>
                                </div>
                                
                                 </div>
                                     <p>{{ $comentario->user->perfil }}</p>
                                     
                                 </div>
                                </div>
                                <p>{{ $comentario->texto }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>





            </div>


            <!-- comentarios -->









        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

        <script>
                document.getElementById('logoutIcon').addEventListener('click', function () {
            var myModal = new bootstrap.Modal(document.getElementById('confirmLogoutModal'));
            myModal.show();
        });

        // Quando o botão "Sair" do modal for clicado, submete o formulário de logout
        document.getElementById('confirmLogoutBtn').addEventListener('click', function () {
            document.getElementById('logout-form').submit();
        });
        </script>
</body>

</html>