<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vega IT - Sistema de Agendamento</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/jquery.js"></script>
    <script src="js/index.js"></script>
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
</head>

<body>
    <header>
        <section id="cabecalho">
            <video id="video-bg" src="assets/video/banner.mp4" autoplay muted loop></video>
            <div id="cabecalho-content">
                <img src="assets/logo.png" alt="Logo da Vega IT">
                <nav>
                    <a href="#">Vamos</a>
                    <a href="#">Ver</a>
                    <a href="#">Aqui</a>
                </nav>
                <a href="../src/views/auth/login.php">
                    <button class="log_button">Login</button>
                </a>  
            </div>
            <h1>
                Vega IT - Soluções Inteligentes para as Suas Necessidades de TI.
            </h1>
            <div id="cabecalho-buttons">
                <a href="#servicos">
                    <button>Conheça Nossos Serviços</button>
                </a>
                <a href="mailto:contato@vegait.com">
                    <button>Entrar em Contato</button>
                </a>
            </div>
        </section>
    </header>

    <main>
        <section id="about">
            <h2>Sobre a nossa empresa</h2>
            <div>
                <img src="assets/img/about_us.jpg" alt="Técnicos trabalhando">
                <p>
                    Na Vega IT, somos apaixonados por tecnologia. Oferecemos serviços especializados para garantir a eficiência e segurança da sua infraestrutura de TI.
                </p>
            </div>
        </section>

        <section id="servicos">
            <h2>Nossos Serviços</h2>
            <div class="card">
                <h3 class="nome_servico">Suporte Técnico</h3>
                <p class="desc_servico">
                    Nosso suporte técnico está disponível para resolver problemas e garantir o bom funcionamento de seus sistemas. Seja por assistência remota ou presencial, estamos prontos para atender suas necessidades de forma ágil e eficaz.
                </p>
            </div>
            <div class="card">
                <h3 class="nome_servico">Manutenção Preventiva</h3>
                <p class="desc_servico">
                    Antecipe problemas com nossas soluções de manutenção preventiva. Realizamos inspeções regulares e ajustes necessários para evitar falhas e prolongar a vida útil de seus equipamentos.
                </p>
            </div>
            <div class="card">
                <h3 class="nome_servico">Manutenção Corretiva</h3>
                <p class="desc_servico">
                    Quando algo não funciona como deveria, nossa equipe de especialistas atua rapidamente para identificar e corrigir o problema. Garantimos que seus sistemas voltem a operar com máxima eficiência.
                </p>
            </div>
            <div class="card">
                <h3 class="nome_servico">Instalação e Configuração de Redes</h3>
                <p class="desc_servico">
                    Conecte sua empresa ao mundo com nossas soluções de redes. Oferecemos serviços completos de instalação e configuração para garantir comunicação eficiente e segura em todos os níveis.
                </p>
            </div>
            <div class="card">
                <h3 class="nome_servico">Backup e Recuperação de Dados</h3>
                <p class="desc_servico">
                    Proteja seus dados com nossas soluções de backup. Além disso, em casos de perda de informações, recuperamos seus arquivos de forma segura e rápida, minimizando os impactos no seu negócio.
                </p>
            </div>
            <div class="card">
                <h3 class="nome_servico">Diagnóstico e Reparo de Hardware</h3>
                <p class="desc_servico">
                    Identificamos problemas de hardware e realizamos reparos precisos para garantir o desempenho ideal de seus equipamentos. Trabalhamos com rapidez e qualidade para evitar interrupções.
                </p>
            </div>
            <div class="card">
                <h3 class="nome_servico">Instalação e Configuração de Software</h3>
                <p class="desc_servico">
                    Implementamos e configuramos softwares de acordo com as necessidades da sua empresa, garantindo compatibilidade, desempenho e segurança em todas as operações.
                </p>
            </div>
        </section>
        
        <section id="depoimentos">
            <h2>O que nossos clientes dizem</h2>
            <div class="slider">
                <div class="card_slide">
                    <img src="assets/img/maria.jpg" alt="Foto de Maria Silva" class="img_cliente">
                    <h3 class="nome_cliente">Maria Silva</h3>
                    <p class="dep_cliente">
                        "A Vega IT transformou nossa experiência com tecnologia. O suporte técnico é sempre ágil e eficiente, e a equipe é extremamente profissional. Recomendo para qualquer empresa que busca serviços de TI de qualidade."
                    </p>
                </div>
                <div class="card_slide">
                    <img src="assets/img/joao.jpg" alt="Foto de João Pereira" class="img_cliente">
                    <h3 class="nome_cliente">João Pereira</h3>
                    <p class="dep_cliente">
                        "Contratei a Vega IT para manutenção preventiva e nunca mais tive problemas inesperados. Eles realmente se preocupam com o cliente e oferecem soluções personalizadas para cada situação."
                    </p>
                </div>
                <div class="card_slide">
                    <img src="assets/img/ana.jpg" alt="Foto de Ana Costa" class="img_cliente">
                    <h3 class="nome_cliente">Ana Costa</h3>
                    <p class="dep_cliente">
                        "Os serviços de backup e recuperação de dados salvaram minha empresa de um grande prejuízo. Agradeço a Vega IT por sua rapidez e competência. Estou muito satisfeita!"
                    </p>
                </div>
            </div>
        </section>
        
        <section id="atendimento">
            <div>
                <img src="assets/img/atendimento.jpg" alt="djdjd">
                <div id="txt_btn">
                    <p>
                        Nosso sistema permite que você organize seus compromissos e acompanhe atividades administrativas de maneira prática e eficiente.
                        Pronto para otimizar sua gestão de serviços? Faça login no sistema e comece agora mesmo!
                    </p>
                    <a href="../src/views/auth/login.php">
                        <button class="log_button">Começar</button>
                    </a>
                </div>
            </div>
            
        </section>
    </main>

    <footer>
        <section>
            <div class="empresa">
                <h2>Empresa</h2>
                <nav>
                    <a href="#about">Sobre</a>
                    <a href="#depoimentos">Clientes</a>
                    <a href="#">Blog</a>
                </nav>
            </div>
            <div class="info">
                <h2>Informações</h2>
                <nav>
                    <a href="tel: (+258)844507076">Cell: (+258) 84 450 7076</a>
                    <a href="mailto:contato@vegait.com">Email: contato@vegait.com</a>
                    <a href="#">Endereço: Moçamique, Maputo, Av. 24 de Julho nrº 1308</a>
                </nav>
            </div>
            <div class="social_media">
                <h2>Siga-nos nas redes sociais</h2>
                <nav class="rodape-redes-menu">
                    <a href="https://www.linkedin.com" target="_blank"><img class="rodape-redes-menu-item" src="assets/img/icons/icon-linkedin.png" alt="Linkedin" title="Linkedin"></a>
                    <a href="https://github.com/oliviorui" target="_blank"><img class="rodape-redes-menu-item" src="assets/img/icons/icon-github.png" alt="Github" title="Github"></a>
                    <a href="https://www.instagram.com/olivio.rui" target="_blank"><img class="rodape-redes-menu-item" src="assets/img/icons/icon-instagram.png" alt="Instagram" title="Instagram"></a>
                    <a href="https://x.com/rui_olivio" target="_blank"><img class="rodape-redes-menu-item" src="assets/img/icons/icon-twitter.png" alt="Twitter/X" title="Twiter/X"></a>
                    <a href="https://wa.me/message/IBUDV67OBJFUE1" target="_blank"><img class="rodape-redes-menu-item" src="assets/img/icons/icon-whatsapp.png" alt="Whatsapp" title="Whatsapp"></a>
                    <a href="https://t.me/oliviorui" target="_blank"><img class="rodape-redes-menu-item" src="assets/img/icons/icon-telegram.png" alt="Telegram" title="Telegram"></a>
                </nav>
            </div>
        </section>

        <p>&copy; <?php echo date("Y"); ?> Vega IT. Todos os direitos reservados.</p>
    </footer>
    
    <script>
        $(document).ready(function() {
            $(window).scrollTop(0);
            if (window.location.hash) {
                history.replaceState(null, null, ' ');
            }
        });
    </script>
</body>
</html>