<style>
    .form-check-input {
        border-color: var(--azul-principal);
    }
</style>

<div class="col-12 card tarjeta borde">
    <h2>Mantenimiento</h2>

    <div class="container" id="mantenimiento">
        <div class="row justify-content-start align-items-start g-2">
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="LimpiezaFisica" id="LimpiezaFisica"
                    name="LimpiezaFisica">
                <label class="form-check-label" for="LimpiezaFisica">
                    Limpieza física
                </label>
            </div>

            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="virus" id="virus" name="virus">
                <label class="form-check-label" for="virus">
                    Análisis de virus
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="restauracion" id="restauracion"
                    name="restauracion">
                <label class="form-check-label" for="restauracion">
                    Crear punto de restauración
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="RespaldoCorreos" id="RespaldoCorreos"
                    name="RespaldoCorreos">
                <label class="form-check-label" for="RespaldoCorreos">
                    Respaldo de correos
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="RespaldoCarpetas" id="RespaldoCarpetas"
                    name="RespaldoCarpetas">
                <label class="form-check-label" for="RespaldoCarpetas">
                    Respaldo de carpetas
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="FortiClient" id="FortiClient" name="FortiClient">
                <label class="form-check-label" for="FortiClient">
                    Instalación/actualización de FortiClient
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="TeamViewer" id="TeamViewer" name="TeamViewer">
                <label class="form-check-label" for="TeamViewer">
                    Instalación/actualización de TeamViewer
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="Zoom" id="Zoom" name="Zoom">
                <label class="form-check-label" for="Zoom">
                    Instalación/actualización de Zoom
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="Office" id="Office" name="Office">
                <label class="form-check-label" for="Office">
                    Revisión de licencias de Office
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="unidadesRed" id="unidadesRed" name="unidadesRed">
                <label class="form-check-label" for="unidadesRed">
                    Conectar unidades de red
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="escritorio" id="escritorio" name="escritorio">
                <label class="form-check-label" for="escritorio">
                    Conexión a escritorio remoto
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="impresoras" id="impresoras" name="impresoras">
                <label class="form-check-label" for="impresoras">
                    Conectar impresoras
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="contraseña" id="contraseña" name="contraseña">
                <label class="form-check-label" for="contraseña">
                    Actualizar contraseña de equipo
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="disco" id="disco" name="disco">
                <label class="form-check-label" for="disco">
                    Comprobación de disco <br> (cambiar si es necesario)
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="programasInicio" id="programasInicio"
                    name="programasInicio">
                <label class="form-check-label" for="programasInicio">
                    Deshabilitar programas de inicio
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="Actualizacion" id="Actualizacion"
                    name="Actualizacion">
                <label class="form-check-label" for="Actualizacion">
                    Actualizaciones de Windows
                </label>
            </div>
            <div class="col-12 col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="inventario" id="inventario" name="inventario">
                <label class="form-check-label" for="inventario">
                    Actualizar datos en inventario
                </label>
            </div>
            <div class="col-12 col-md-8 form-check">
                <input class="form-check-input" type="checkbox" value="bateria" id="bateria" name="bateria">
                <label class="form-check-label" for="bateria">
                    Comprobación de batería <br><b>powercfg /batteryreport /output C:\battery-report.html</b>
                </label>
            </div>
        
        </div>
    </div>
</div>
