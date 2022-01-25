<template>
    <div class="container">
        <h1 class="text-center">Gestionar Proyectos</h1>
        <hr />

        <button
            @click="
                modificar = false;
                abrirModal();
            "
            type="button"
            class="btn btn-primary my-4"
        >
            Nuevo
        </button>

        <!-- The Modal -->
        <div class="modal" :class="{ mostrar: modal }">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                        <button
                            @click="cerrarModal()"
                            type="button"
                            class="close"
                            data-dismiss="modal"
                        >
                            &times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="my-4">
                            <label for="Title">Titulo</label>
                            <input
                                type="text"
                                v-model="project.title"
                                id="title"
                                class="form-control"
                                placeholder="Titulo"
                            />
                            <span class="text-danger" v-if="errores.title">{{
                                errores.title[0]
                            }}</span>
                        </div>
                        <div class="my-4">
                            <label for="SubTitle">SubTitulo</label>
                            <input
                                type="text"
                                v-model="project.subtitle"
                                id="subtitle"
                                class="form-control"
                                placeholder="SubTitulo"
                            />
                            <span class="text-danger" v-if="errores.subtitle">{{
                                errores.subtitle[0]
                            }}</span>
                        </div>
                        <div class="my-4">
                            <label for="Descripcion">Descripción</label>
                            <input
                                type="text"
                                v-model="project.description"
                                id="description"
                                class="form-control"
                                placeholder="Descripcion"
                            />
                            <span
                                class="text-danger"
                                v-if="errores.description"
                                >{{ errores.description[0] }}</span
                            >
                        </div>
                        <div class="my-4">
                            <label for="Logo">Logo</label>
                            <div v-if="!image">
                                <input type="file" @change="onFileChange" />
                            </div>
                            <div v-else>
                                <img class="img-logo" :src="image" />
                                <button @click="removeImage">
                                    Remove image
                                </button>
                            </div>
                        </div>
                        <div class="my-4">
                            <label for="imagen">Imagen Principal</label>
                            <div v-if="!wallpaper">
                                <input
                                    type="file"
                                    @change="onWallpaperFileChange"
                                />
                            </div>
                            <div v-else>
                                <img class="img-logo" :src="wallpaper" />
                                <button @click="removeWallpaper">
                                    Remover wallpaper
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button
                            @click="cerrarModal()"
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cancelar
                        </button>
                        <button
                            @click="guardar()"
                            type="button"
                            class="btn btn-success"
                            data-dismiss="modal"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <table
            class="table table-striped table-bordered table-hover table-dark"
        >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrpcion</th>

                    <th scope="col" colspan="3" class="text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ques in projects.data" :key="ques.id">
                    <th scope="row">{{ ques.id }}</th>
                    <td>{{ ques.description }}</td>

                    <td>
                        <button
                            @click="
                                modificar = true;
                                abrirModal(ques);
                            "
                            class="btn btn-warning"
                        >
                            Editar
                        </button>
                    </td>
                    <td>
                        <button
                            @click="eliminar(ques.id)"
                            class="btn btn-danger"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-4 md-4"></div>
            <div class="col-2 md-2"></div>
            <div class="col-6 md-6">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li
                            class="page-item"
                            :class="{ disabled: pagination.page == 1 }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click="
                                    pagination.page = 1;
                                    listar();
                                "
                                >&laquo;</a
                            >
                        </li>
                        <li
                            class="page-item"
                            :class="{ disabled: pagination.page == 1 }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click="
                                    pagination.page--;
                                    listar();
                                "
                                >&lt;</a
                            >
                        </li>
                        <li
                            class="page-item"
                            v-for="n in projects.last_page"
                            :key="n"
                            :class="{ disabled: pagination.page == n }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click="
                                    pagination.page = n;
                                    listar();
                                "
                                >{{ n }}</a
                            >
                        </li>
                        <li
                            class="page-item"
                            :class="{
                                disabled: pagination.page == projects.last_page
                            }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click="
                                    pagination.page++;
                                    listar();
                                "
                                >&gt;</a
                            >
                        </li>
                        <li
                            class="page-item"
                            :class="{
                                disabled: pagination.page == projects.last_page
                            }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click="
                                    pagination.page = projects.last_page;
                                    listar();
                                "
                                >&raquo;</a
                            >
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            project: {
                description: "",
                title: "",
                subtitle: "",
                logo: null,
                wallpaper: null
            },
            id: 0,
            modificar: true,
            modal: 0,
            tituloModal: "",
            projects: [],
            selectedImage: null,
            image: "",
            wallpaper: "",
            errores: {},
            pagination: {
                page: 1,
                per_page: 5
            }
        };
    },
    methods: {
        async listar() {
            const res = await axios.get("/projects", {
                params: this.pagination
            });
            console.log("entro a listar");
            console.log(res.data);
            this.projects = res.data;
        },
        async eliminar(id) {
            const res = await axios.delete("/projects/" + id);
            this.listar();
        },
        async guardar(id) {
            console.log("entro a guardar");
            console.log(this.project);
            try {
                if (this.modificar) {
                    const res = await axios.put(
                        "/projects/" + this.id,
                        this.project
                    );
                } else {
                    const res = await axios.post("/projects/", this.project);
                }
                this.cerrarModal();
                this.listar();
            } catch (error) {
                if (error.response.data) {
                    this.errores = error.response.data.errors;
                }
            }
        },
        abrirModal(data = {}) {
            if (this.modificar) {
                (this.id = data.id), (this.tituloModal = "Modificar");
                this.project.description = data.description;
            } else {
                (this.id = 0), (this.tituloModal = "Crear proyecto");
                this.project.description = "";
            }
            this.modal = 1;
        },
        cerrarModal() {
            this.modal = 0;
            this.errores = {};
        },
        respuestas(data = {}) {
            (this.id = data.id),
                window.location.assign("/responses?project_id=" + this.id);
        },
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = e => {
                vm.image = e.target.result;
                vm.project.logo = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(e) {
            this.image = "";
            this.project.logo = "";
        },
        onWallpaperFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createWallpaperImage(files[0]);
        },
        createWallpaperImage(file) {
            var wallpaper = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = e => {
                vm.wallpaper = e.target.result;
                vm.project.wallpaper = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeWallpaper: function(e) {
            this.wallpaper = "";
            this.project.wallpaper = "";
        }
    },

    mounted() {},
    created() {
        this.listar();
    }
};
</script>
<style>
.mostrar {
    display: list-item;
    opacity: 1;
    background: rgba(red, green, blue, alpha);
}
.img-logo {
    max-width: 30%;
    max-height: 30%;
    margin: auto;
    display: block;
    margin-bottom: 10px;
}
</style>
