<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h1 class="text-white text-center">
                        <br />
                        <br />
                        <br />
                        Nos especializamos en
                        <b style="color: green;">
                            <br />interfaces digitales que los usuarios aman
                        </b>
                    </h1>
                    <br />
                    <br />
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12 text-center">
                <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    style="background-color: green;"
                >
                    HABLEMOS DE TU PROYECTO
                </button>
            </div>
        </div>
        <br />
        <div class="row mt-2">
            <div class="col-md-12" v-for="project in projects.data" :key="project.id">
                <div class="card mb-12" style="max-width: 100%; background-color: black; color: white;">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img

                                :src="baseUrl+'/storage/'+project.wallpaper"
                                class="img-fluid rounded-start"
                                alt=""
                            />
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="d-inline">
                                    <img
                                        :src="baseUrl+'/storage/'+project.logo"
                                        style="border-radius: 50%;"
                                        width="40"
                                        height="30"
                                        alt=""
                                    />
                                    <h5 class="card-title d-inline">
                                        {{project.title}}
                                    </h5>
                                </div>

                                
                                <p class="card-text">
                                    <h5>{{project.subtitle}}</h5>
                                    {{project.description}}
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                            <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        </svg>
                                        <u>Usabilidad </u>&nbsp; 
                                        <u> ui </u>&nbsp; 
                                        <u> ux</u>&nbsp; 
                                        </small
                                    >
                                </p>
                                <a href="#" class="btn btn-primary"
                                    >Ver detalles</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            baseUrl: window.location.origin,
            foto: null,
            projects: [],
            id: 0,
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
        },
    mounted() {
        console.log("Component mounted.");
        
    },
    created() {
        this.listar()
        this.foto = this.baseUrl+'/storage/wallpapers/fb2c92f5093f0d67dd4b6032b4da5c15.jpeg'
        console.log(this.foto);
    }
};
</script>
