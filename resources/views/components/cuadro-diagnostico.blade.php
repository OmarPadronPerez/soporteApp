<style>

</style>


<div class="mb-3">
    <label for="Diagnostico" id="Diagnostico_label" name="Diagnostico_label" class="form-label">
        @php
            $diagnostico = '';
        @endphp
        @if ($falla != 'TIMBRADO')
            <h3>Diagnóstico técnico</h3>
            @php
                if (isset($datoDiagnostico)) {
                    $diagnostico = $datoDiagnostico;
                }
            @endphp
        @else
            <h3>Fallas al timbrar</h3>
            @php
                if (isset($datoDiagnostico)) {
                    $diagnostico = $datoDiagnostico;
                }
            @endphp
        @endif
    </label>

    <textarea class="form-control" name="Diagnostico" id="Diagnostico" rows="3">{{ $diagnostico }}</textarea>
</div>
