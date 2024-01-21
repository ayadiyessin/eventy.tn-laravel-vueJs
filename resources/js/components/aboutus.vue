<template>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/">
                            <i class="fa fa-home"></i> Accueil
                        </router-link>
                        <span>A propos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <section class="about ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="../components/img/about.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Notre Mission ?</h4>
                        <p class="justify-text">Nous nous engageons à simplifier votre quête de moments mémorables et
                            d'offres exclusives.
                            Notre mission est de vous aider à trouver les événements les plus captivants, des festivals aux
                            concerts,
                            et à dénicher les bons plans les plus alléchants,
                            que ce soit pour des sorties, des activités, ou des promotions exceptionnelles.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Ce que nous offrons ?</h4>
                        <p class="justify-text">
                        <ul>
                            <li>Une base de données complète d'événements locaux, nationaux et internationaux.</li>
                            <li>Des bons plans triés sur le volet pour économiser sur vos activités préférées.</li>
                            <li>Une plateforme interactive où la communauté peut partager ses propres découvertes.</li>
                        </ul>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Engagement envers Vous ?</h4>
                        <p class="justify-text">
                            Chez Eventy.tn, nous nous engageons à vous offrir une expérience transparente, conviviale et
                            enrichissante.
                            Votre satisfaction est notre priorité,
                            et nous travaillons sans relâche pour vous garantir des moments inoubliables à chaque visite sur
                            notre site.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>

</script>

<style lang="css" scoped>
.justify-text {
    text-align: justify;
}

.about__item li {
    font-size: 15px;
    font-family: "Nunito Sans", sans-serif;
    color: #3d3d3d;
    font-weight: 400;
    line-height: 25px;
    text-align: justify;

}</style>
