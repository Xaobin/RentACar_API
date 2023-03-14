<template>
    <div class="modal fade" :id="modalid" tabindex="-1" :aria-labelledby="modalid" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="modalid">{{title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <slot name="alerts"></slot>
                <slot name="content"></slot>
            </div>
                <div class="modal-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['modalid', 'title']
    }
</script>