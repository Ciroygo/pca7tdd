<template>
    <div class="card mt-4" :id="'reply' + id">
        <div class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a :href="'/profiles/' + data.owner.name" v-text="data.owner.name"></a>
                    回复于 {{ data.created_at }} ...
                </h5>

<!--                @if(Auth::check())-->
<!--                <div>-->
<!--                    <favorite :reply="{{ $reply }}">组件损坏</favorite>-->
<!--                </div>-->
<!--                @endif-->
            </div>

        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
        </div>

<!--        @can('update', $reply)-->
<!--            <div class="card-footer level">-->

<!--                <button class="btn btn-light btn-sm mr-1" @click="editing = true">Edit</button>-->

<!--                <button class="btn btn-danger btn-sm mr-1" @click="destroy">Delete</button>-->
<!--            </div>-->
<!--        @endcan-->
    </div>
</template>
<script>
    import Favorite from './Favorite';

    export default {
        props: ['data'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                $(this.$el).fadeOut(300, () => {
                    flash('Your reply has been deleted!');
                });
            }
        }
    }
</script>