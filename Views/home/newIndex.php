<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yonny ameo</title>
    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
    <script>
        var botmanWidget = {
            introMessage: 'Bienvenido',
            frameEndpoint: '../../Vendor/botman/chat.php',
            chatServer: '../../Vendor/botman/botman.php',
        }
    </script>
    <!-- CSS -->
    <link rel="stylesheet" href="../../Public/cssPuro/newStyle.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-1">
            <a href="#" class="logo"><i class="fas fa-book"></i> Yonny</a>
            <form action="" class="search-form" method="">
                <input type="search" name="" placeholder="Buscar..." id="search-box">
                <label for="search-box" class="fas fa-search"></label>
            </form>

            <div class="icons">
                <div id="search-btn" class="fas fa-search"></div>
                <a href="#" class="fas fa-shopping-cart"></a>
                <div id="login-btn" class="fas fa-user"></div>
            </div>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="#ingresos">Ingresos</a>
                <a href="#reviews">Reviews</a>
                <a href="#contacto">Contacto</a>
            </nav>
        </div>
    </header>

    <!-- Nav pal responsive -->
    <nav class="bottom-navbar">
        <a href="#" class="fas fa-home"></a>
        <a href="#ingresos" class="fas fa-tags"></a>
        <a href="#reviews" class="fas fa-comments"></a>
        <a href="#contacto" class="fas fa-blogs"></a>
    </nav>

    <!-- Login. Despues vemos si se deja aca o no
    yo dejo uno sencillito para ya tener una maqueta -->
    <div class="login-form-container">
        <div id="close-login-btn" class="fas fa-times"></div>
        <form action="" method="">
            <h3>Login</h3>
            <span>Usuario</span>
            <input type="text" name="usuario" class="box" placeholder="Ingrese su usuario" id="">
            <span>Contraseña</span>
            <input type="password" name="contrasenia" class="box" placeholder="Ingrese su contraseña" id="">
            <div class="checkbox">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
            <input type="submit" value="Sign in" class="btn">
            <p>Te olvidaste la contraseña pa? <a href="#">Clickea aca ;)</a> </p>
            <p>No tenes una cuenta? <a href="#">Create una papu</a> </p>
        </form>
    </div>


    <!-- Home -->
    <section class="home" id="home">
        <div class="row">
            <div class="content">
                <h3>Al 75% de descuento</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut ad enim debitis delectus a voluptates optio qui commodi, ratione totam.</p>
                <a href="#" class="btn">Comprar ya</a>
            </div>

            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <a href="#" class="swiper-slide"><img src="../../Public/img/libro-1.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../../Public/img/libro-2.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../../Public/img/libro-3.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../../Public/img/libro-4.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../../Public/img/libro-5.png" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="../../Public/img/libro-6.png" alt=""></a>
                </div>
                <img src="../../Public/img/stand.png" class="stand" alt="">
            </div>
        </div>
    </section>

    <!-- Iconcitos fachas -->
    <section class="icons-container">
        <div class="icons">
            <i class="fas fa-plane"></i>
            <div class="content">
                <h3>Envíos gratis a todo el país</h3>
                <p>En pedidos mayores a $4000</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-lock"></i>
            <div class="content">
                <h3>Pagos seguros</h3>
                <p>Tarjetas de crédito, débito y mercado pago</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-redo-alt"></i>
            <div class="content">
                <h3>Reembolsos</h3>
                <p>Luego de haber recibido el producto</p>
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-headset"></i>
            <div class="content">
                <h3>Atención 24/7</h3>
                <p>Consúltenos en cualquier momento</p>
            </div>
        </div>
    </section>

    <section class="ingresos" id="ingresos">
        <h1 class="heading"> <span>Nuevos Ingresos</span> </h1>
        <div class="swiper ingresos-slider">
            <div class="swiper-wrapper">
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="../../Public/img/libro-1.png" alt="">
                    </div>
                    <div class="content">
                        <h3>El Señor de los Anillos - Las Dos Torres</h3>
                        <div class="price">$3599</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="../../Public/img/libro-2.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Nuevo ingreso</h3>
                        <div class="price">$2599</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="../../Public/img/libro-3.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Nuevo ingreso</h3>
                        <div class="price">$2599</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="../../Public/img/libro-4.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Nuevo ingreso</h3>
                        <div class="price">$2599</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="../../Public/img/libro-5.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Nuevo ingreso</h3>
                        <div class="price">$2599</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="../../Public/img/libro-6.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Nuevo ingreso</h3>
                        <div class="price">$2599</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="oferta">
        <div class="content">
            <h3>Oferta del dia!</h3>
            <h1>50% de descuento</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae velit ipsam dicta dignissimos odio iusto incidunt laborum ipsa, recusandae cumque!</p>
            <a href="#" class="btn">Comprar ya</a>
        </div>
        <div class="image">
            <img src="../../Public/img/oferta.jpg" alt="compralo wachin">
        </div>
    </section>

    <section class="reviews" id="reviews">
        <h1 class="heading"><span>Reviews de clientes</span></h1>
        <div class="swiper reviews-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-1.png" alt="">
                    <h3>John Salchichon</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ut!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-2.png" alt="">
                    <h3>John Salchichon</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ut!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-3.png" alt="">
                    <h3>John Salchichon</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ut!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-4.png" alt="">
                    <h3>John Salchichon</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ut!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-6.png" alt="">
                    <h3>John Salchichon</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ut!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="../../Public/img/pic-5.png" alt="">
                    <h3>John Salchichon</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ut!</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter">
        <form action="" method="">
            <h3>Suscríbete para obtener las últimas novedades</h3>
            <input type="email" name="mail" id="mail" placeholder="Ingrese su email" class="box">
            <input type="submit" value="Suscribirse" class="btn">
        </form>
    </section>

    <footer class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Nuestras sucursales</h3>
                <a href="#"><i class="fas fa-map-marker-alt"></i>La FAI</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>La casa del masi</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>La casa del jero</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>La casa de mar</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>La casa del gonza</a>
            </div>
            <div class="box">
                <h3>Quick links</h3>
                <a href="#"><i class="fas fa-arrow-right"></i>Home</a>
                <a href="#"><i class="fas fa-arrow-right"></i>Ingresos</a>
                <a href="#"><i class="fas fa-arrow-right"></i>Reviews</a>
                <a href="#"><i class="fas fa-arrow-right"></i>Contacto</a>
            </div>
            <div class="box">
                <h3>Extra links</h3>
                <a href="#"><i class="fas fa-arrow-right"></i>Información de la cuenta</a>
                <a href="#"><i class="fas fa-arrow-right"></i>Productos comprados</a>
            </div>
        </div>
        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
        </div>
        <div class="credit">
            <p>© Developed by Gonzalo Parra, Jerónimo Rojo, Marcia Klimisch & Maximiliano Ariel Hitter | 2022</p>
        </div>
    </footer>


<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- JS -->
<script src="../../Public/jsPuro/script.js"></script>

</body>
</html>