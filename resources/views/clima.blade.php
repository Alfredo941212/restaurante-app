@extends('layouts.inicio')
@section('informacion')
    <div class="container">
        <h1 id="titulo" class="display-4 mt-5 text-dark font-weight-bold text-uppercase text-center">Busca el Clima</h1>
        <div class="w-75 mx-auto">

            <div class="p-4 mt-4">
                <div id="resultado">
                    <p class="text-center text-muted">Agrega tu ciudad y país, el resultado se mostrará aquí</p>
                </div>
            </div>

            <form id="formulario" class="mt-4" action="#" method="POST">
                <div class="form-group">
                    <input type="text" name="ciudad" id="ciudad" placeholder="Escribe tu Ciudad"
                        class="form-control" />
                </div>
                <div class="form-group mt-3">
                    <select class="form-control" id="pais">
                        <option disabled selected value="">-- Seleccione --</option>
                        <option value="AR">Argentina</option>
                        <option value="CO">Colombia</option>
                        <option value="CR">Costa Rica</option>
                        <option value="ES">España</option>
                        <option value="US">Estados Unidos</option>
                        <option value="MX">México</option>
                        <option value="PE">Perú</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary mt-3" value="Obtener Clima" />
            </form>

        </div>
    </div>

    <script>
        const container = document.querySelector('.container')
        const resultado = document.querySelector('#resultado')
        const formulario = document.querySelector('#formulario')

        window.addEventListener('load', () => {
            formulario.addEventListener('submit', buscarClima)
        })

        function buscarClima(e) {
            e.preventDefault();

            //Validar
            const ciudad = document.querySelector('#ciudad').value;
            const pais = document.querySelector('#pais').value;

            if (ciudad === '' || pais === '') {
                //Hubo un error
                mostrarError('Ambos campos son obligatorios')
                return;
            }

            //Consultamos la API
            consultarAPI(ciudad, pais);
        }

        function mostrarError(mensaje) {
            const alertaExistente = document.querySelector('.alert');
            if (!alertaExistente) {
                const alerta = document.createElement('div');
                alerta.classList.add('alert', 'alert-danger', 'text-center', 'mt-3');
                alerta.innerHTML = `<strong>Error:</strong> ${mensaje}`;

                container.insertBefore(alerta, formulario);

                setTimeout(() => {
                    alerta.remove();
                }, 5000);
            }
        }

        function consultarAPI(ciudad, pais) {
            const appId = '2ef7d91aaf68dde69e58c9f06b753888';

            const url = `https://api.openweathermap.org/data/2.5/weather?q=${ciudad},${pais}&appid=${appId}`;

            fetch(url)
                .then(respuesta => respuesta.json())
                .then(datos => {
                    limpiarHTML()
                    if (datos.cod === "404") {
                        mostrarError('Ciudad no encontrada');
                        return;
                    }
                    mostrarClima(datos);
                })
                .catch(error => {
                    mostrarError('Hubo un error en la consulta');
                    console.error(error);
                });
        }

        function mostrarClima(datos) {
            const { name, main: { temp, temp_max, temp_min } } = datos;

            const centigrados = kelvinACentigrados(temp);
            const max = kelvinACentigrados(temp_max);
            const min = kelvinACentigrados(temp_min);

            const actual = document.createElement('p');
            actual.innerHTML = `<strong>Clima en ${name}:</strong> ${centigrados} &#8451;`;
            actual.classList.add('h4', 'text-primary');

            const tempMaxima = document.createElement('p');
            tempMaxima.innerHTML = `Max: ${max} &#8451;`;
            tempMaxima.classList.add('text-info');

            const tempMinima = document.createElement('p');
            tempMinima.innerHTML = `Min: ${min} &#8451;`;
            tempMinima.classList.add('text-success');

            const resultadoDiv = document.createElement('div');
            resultadoDiv.classList.add('text-center', 'bg-light', 'p-4', 'rounded', 'mt-4');

            resultadoDiv.appendChild(actual);
            resultadoDiv.appendChild(tempMaxima);
            resultadoDiv.appendChild(tempMinima);

            resultado.appendChild(resultadoDiv);
        }

        function kelvinACentigrados(grados) {
            return parseInt(grados - 273.15);
        }

        function limpiarHTML() {
            while (resultado.firstChild) {
                resultado.removeChild(resultado.firstChild);
            }
        }
    </script>
@endsection