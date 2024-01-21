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
                            <router-link to="/ListePubic"> Liste Publications</router-link>
                            <span>Ajouter Publication</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card form_prof">
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reference" class="form-label">Référence</label>
                                    <input type="text" class="form-control" id="reference">
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="designation" class="form-label">Désignation</label>
                                    <input type="texte" class="form-control" id="designation">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marque" class="form-label">Marque</label>
                                    <input type="text" class="form-control" id="marque">
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="Quantité" class="form-label">Qtock</label>
                                    <input type="texte" class="form-control" id="qtestock">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prix" class="form-label">Prix</label>
                                    <input type="text" class="form-control" id="prix">
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="scategorie" class="form-label">Sous Catégorie</label>
                                    <select class="form-control">
                                        <option>--cat--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                                allow-multiple="false" accepted-file-types="image/jpeg, image/png" />
                        </div>
                        <br />
                        <div class="card-footer">

                            <router-link class="btn btn-outline-secondary" to="/ListePubicRest">Retour</router-link>
                            <button type="submit" class="btn btn-outline-primary float-right">Enregistrer</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped></style>
