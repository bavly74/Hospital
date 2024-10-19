<template>
    <div>
        <form  method="post" autocomplete="off" enctype="multipart/form-data">

                    <div class="bg-gray-200 pd-30 pd-sm-40">

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="name">
                                    group name</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="name" type="text">
                            </div>
                        </div>


                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="description">
                                    description</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="description" type="text">
                            </div>
                        </div>




                        <div class="row row-xs align-items-center mg-b-20">


                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <select name="services" class="form-control SlectBox">
                                    <option v-for="service in services" :key="service.id">
                                        {{ service.description }}
                                    </option>

                                </select>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">submit</button>
                    </div>
                </form>
    </div>
</template>

<script>
    export default {

        props: {
            services: {
            type: Array,
            required: true
        }
    }
}
</script>
