<div class="alert alert-outline-warning fade show" role="alert">
    <div class="row">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text"></div>
        <div class="col-md-12 alert-message">
            <div class="errors" v-if="errors" style="text-align: left">
                <ul>
                    <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                        <strong>@{{ fieldsError.join('\n ')}}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
