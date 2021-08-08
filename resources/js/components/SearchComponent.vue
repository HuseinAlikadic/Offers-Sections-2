<template>
    <div>
        <form action="api/search-offer" method="GET">
            <div class="input-group mb-3">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Search"
                    name="searchOffer"
                />
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">
                        Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Search",
    props: {},
    data() {
        return {
            ppp: "kkk"
        };
    }
};
</script>

<style></style>
