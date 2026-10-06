<?php
session_start()
?>

<!DOCTYPE html>  <html lang="pt-BR">  <head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <title>La Fome - Restaurante</title>  

<link rel="preconnect" href="https://fonts.googleapis.com">  
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap"  
    rel="stylesheet">  

<link rel="stylesheet" href="css/index.css">
</head>  
<body>  <!-- CABEÇALHO -->  

<header>  

    <div class="logo">  
        La Fome  
    </div>  

    <nav>  

        <a href="#inicio">Início</a>  

        <a href="#cardapio">Cardápio</a>  

        <a href="#sobre">Sobre</a>  

        <a href="#avaliacoes">Avaliações</a>  

        <a href="#contato">Contato</a> 
        
        <a class="login-btn" href="login.php">Login</a>
        <?php if (isset($_SESSION['email'])): ?>

        <a class="login-btn" href="usuarios.php">Lista de usuarios</a>
        
        <a href="sair.php"> Sair </a>
        <?php endif; ?>
    </nav>  

</header>  


<!-- HERO -->  

<section class="hero" id="inicio">  

    <div class="hero-content">  

        <h1>  
            O sabor que fica na memória.  
        </h1>  

        <p>  
            Uma experiência gastronômica especial,  
            feita para transformar cada refeição  
            em um momento inesquecível.  
        </p>  

        <a href="#cardapio" class="btn">  
            Ver Cardápio  
        </a>  

        <a href="#contato" class="btn btn-outline">  
            Reservar Mesa  
        </a>  

    </div>  

</section>  


<!-- INTRODUÇÃO -->  

<section>  

    <div class="titulo">  

        <span>BEM-VINDO</span>  

        <h2>  
            Bem-vindo à La Fome  
        </h2>  

    </div>  

    <div class="intro">  

        <p>  
            Na La Fome, cada detalhe foi pensado para  
            proporcionar uma experiência única.  
            Ingredientes selecionados, pratos preparados  
            com cuidado e um ambiente especial para você  
            aproveitar cada momento.  
        </p>  

    </div>  

</section>  


<!-- CARDÁPIO -->  

<section id="cardapio">  

    <div class="titulo">  

        <span>NOSSO MENU</span>  

        <h2>  
            Cardápio  
        </h2>  

    </div>  


    <!-- CATEGORIAS -->  

    <div class="categorias">  

        <div class="categoria">  

            <h3>  
                Carnes Nobres  
            </h3>  

            <p>  
                Cortes selecionados e preparados  
                no ponto ideal.  
            </p>  

        </div>  


        <div class="categoria">  

            <h3>  
                Massas  
            </h3>  

            <p>  
                Massas preparadas com ingredientes  
                especiais.  
            </p>  

        </div>  


        <div class="categoria">  

            <h3>  
                Frutos do Mar  
            </h3>  

            <p>  
                Sabores frescos e combinações  
                especiais.  
            </p>  

        </div>  


        <div class="categoria">  

            <h3>  
                Vinhos  
            </h3>  

            <p>  
                Uma seleção para acompanhar  
                sua refeição.  
            </p>  

        </div>  

    </div>  


    <!-- PRATOS -->  

    <div class="pratos">  


        <div class="prato">  

            <img  
                src="https://images.unsplash.com/photo-1546833999-b9f581a1996d?auto=format&fit=crop&w=800&q=80"  
                alt="Filé La Fome">  

            <div class="prato-info">  

                <h3>  
                    Filé La Fome  
                </h3>  

                <p>  
                    Filé macio acompanhado de  
                    molho especial da casa.  
                </p>  

                <div class="preco">  
                    R$ 79,90  
                </div>  

            </div>  

        </div>  


        <div class="prato">  

            <img  
                src="https://images.unsplash.com/photo-1476124369491-e7addf5db371?auto=format&fit=crop&w=800&q=80"  
                alt="Risoto de Funghi">  

            <div class="prato-info">  

                <h3>  
                    Risoto de Funghi  
                </h3>  

                <p>  
                    Risoto cremoso com cogumelos  
                    selecionados.  
                </p>  

                <div class="preco">  
                    R$ 59,90  
                </div>  

            </div>  

        </div>  


        <div class="prato">  

            <img  
                src="https://www.shutterstock.com/image-photo/avocado-shrimp-sandwiches-isolated-on-260nw-2753808263.jpg"  
                alt="Camarão Especial">  

            <div class="prato-info">  

                <h3>  
                    Camarão Especial  
                </h3>  

                <p>  
                    Camarões preparados com molho  
                    especial e acompanhamentos.  
                </p>  

                <div class="preco">  
                    R$ 69,90  
                </div>  

            </div>  

        </div>  


        <div class="prato">  

            <img  
                src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=800&q=80"  
                alt="Hambúrguer Artesanal">  

            <div class="prato-info">  

                <h3>  
                    Hambúrguer Artesanal  
                </h3>  

                <p>  
                    Hambúrguer artesanal com ingredientes  
                    selecionados.  
                </p>  

                <div class="preco">  
                    R$ 39,90  
                </div>  

            </div>  

        </div>  


        <div class="prato">  

            <img  
                src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?auto=format&fit=crop&w=800&q=80"  
                alt="Massa Especial">  

            <div class="prato-info">  

                <h3>  
                    Massa Especial  
                </h3>  

                <p>  
                    Massa artesanal com molho  
                    preparado na casa.  
                </p>  

                <div class="preco">  
                    R$ 49,90  
                </div>  

            </div>  

        </div>  


        <div class="prato">  

            <img  
                src="https://images.unsplash.com/photo-1574071318508-1cdbab80d002?auto=format&fit=crop&w=800&q=80"  
                alt="Pizza da Casa">  

            <div class="prato-info">  

                <h3>  
                    Pizza da Casa  
                </h3>  

                <p>  
                    Pizza artesanal com ingredientes  
                    selecionados.  
                </p>  

                <div class="preco">  
                    R$ 44,90  
                </div>  

            </div>  

        </div>  

    </div>  


    <!-- CARDÁPIO COMPLETO -->  

    <div class="menu-completo">  

        <p>  
            Confira nosso cardápio completo pelo WhatsApp.  
        </p>  

        <a  
            href="https://wa.me/5521999999999?text=Olá!%20Gostaria%20de%20ver%20o%20cardápio%20completo%20da%20La%20Fome."  
            target="_blank"  
            class="btn">  

            Cardápio completo  

        </a>  

    </div>  

</section>  


<!-- SOBRE -->  

<section id="sobre">  

    <div class="sobre">  


        <img  
            src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1000&q=80"  
            alt="Interior do restaurante La Fome">  


        <div class="sobre-texto">  

            <span>  
                NOSSA HISTÓRIA  
            </span>  

            <h2>  
                Mais que uma refeição.  
            </h2>  

            <p>  
                A La Fome nasceu da vontade de criar  
                um lugar onde boa comida e bons momentos  
                pudessem estar juntos.  
            </p>  

            <p>  
                Trabalhamos com ingredientes selecionados  
                e buscamos oferecer uma experiência especial  
                em cada prato servido.  
            </p>  

            <a href="#contato" class="btn">  
                Conheça a La Fome  
            </a>  

        </div>  

    </div>  

</section>  


<!-- AVALIAÇÕES -->  

<section id="avaliacoes">  

    <div class="titulo">  

        <span>CLIENTES</span>  

        <h2>  
            O que dizem  
        </h2>  

    </div>  


    <div class="avaliacoes">  


        <div class="avaliacao">  

            <div class="estrelas">  
                ★★★★★  
            </div>  

            <p>  
                "Ambiente maravilhoso e comida  
                simplesmente incrível. Com certeza  
                vou voltar."  
            </p>  

            <h4>  
                Mariana Silva  
            </h4>  

        </div>  


        <div class="avaliacao">  

            <div class="estrelas">  
                ★★★★★  
            </div>  

            <p>  
                "Atendimento excelente e pratos  
                muito bem preparados. Uma ótima  
                experiência."  
            </p>  

            <h4>  
                João Pedro  
            </h4>  

        </div>  


        <div class="avaliacao">  

            <div class="estrelas">  
                ★★★★★  
            </div>  

            <p>  
                "Lugar perfeito para jantar.  
                A comida estava deliciosa e o  
                ambiente é muito bonito."  
            </p>  

            <h4>  
                Camila Souza  
            </h4>  

        </div>  

    </div>  

</section>  


<!-- RESERVA -->  

<section class="reserva">  

    <h2>  
        Vamos tornar sua noite especial?  
    </h2>  

    <p>  
        Faça sua reserva e venha viver  
        uma experiência La Fome.  
    </p>  

    <a  
        href="reserva.php"  
        class="btn">  

        Reservar

    </a>  

</section>  


<!-- INFORMAÇÕES -->  

<section class="informacoes" id="contato">  

    <div class="titulo">  

        <span>FALE CONOSCO</span>  

        <h2>  
            Informações  
        </h2>  

    </div>  


    <div class="info-grid">  


        <div class="info-box">  

            <h3>  
                Endereço  
            </h3>  

            <p>  
                📍 Rua Amostradinho, 67  
            </p>  

        </div>  


        <div class="info-box">  

            <h3>  
                Contato  
            </h3>  

            <p>  
                📞 (21) 99999-9999  
            </p>  

            <p>  
                ✉ contato@lafome.com.br  
            </p>  

        </div>  


        <div class="info-box">  

            <h3>  
                Funcionamento  
            </h3>  

            <p>  
                Segunda a Domingo  
            </p>  

            <p>  
                11:00 às 23:00  
            </p>  

        </div>  

    </div>  

</section>  


<!-- RODAPÉ -->  

<footer>  

    <div class="logo">  
        La Fome  
    </div>  

    <p>  
        © 2026 La Fome. Todos os direitos reservados.  
    </p>  

</footer>  


<!-- BOTÃO FLUTUANTE WHATSAPP -->  

<a  
    class="whatsapp"  
    href="https://wa.me/5521999999999?text=Olá!%20Gostaria%20de%20falar%20com%20a%20La%20Fome."  
    target="_blank"  
    title="Falar pelo WhatsApp">  

    ☎  

</a>  


<!-- JAVASCRIPT -->  

<script src="js/index.js"></script>

</body>  
</html>
