<template>
    <button class="btn btn-default" type="submit">
        <span class="glyphicon glyphicon-heart"></span>
        <span class="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        data() {
            return {
                favoritesCount: 10
            }
        }
    }
</script>