<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conversão de Moedas</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script defer src="{{mix('/js/app.js')}}"></script> 
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>
<body>
    <main>
      <div class="container h-full">
          <div class="row h-full align-items-center justify-content-center">
            <div class="col">
              <div class="card">
                <div class="card-body" x-data="{ errors: [], fatalError: false }">
                    <div class="mb-3">
                      <label for="value" class="form-label">Valor</label>
                      <input type="text" class="form-control is-invalid" id="value" x-ref="value" x-bind:class="{'is-invalid': errors['value']}">
                      <div class="form-text">Utilizar . (ponto) para casa decimais.</div>
                      <template x-if="errors['value']">
                        <div class="invalid-feedback">
                          <template x-for="item in errors['value']" :key="item">
                            <div x-text="item"></div>
                          </template>
                        </div>
                      </template>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="base">Base</label>
                        <select class="form-select" id="base" x-ref="base" x-bind:class="{'is-invalid': errors['base']}">
                          <option selected>Escolha...</option>
                          <option value="BRL">BRL</option>
                          <option value="USD">USD</option>
                          <option value="EUR">EUR</option>
                        </select>
                        <template x-if="errors['base']">
                          <div class="invalid-feedback">
                            <template x-for="item in errors['base']" :key="item">
                              <div x-text="item"></div>
                            </template>
                          </div>
                        </template>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="to">Para</label>
                        <select class="form-select" id="to" x-ref="to" x-bind:class="{'is-invalid': errors['to']}">
                          <option selected>Escolha...</option>
                          <option value="BRL">BRL</option>
                          <option value="USD">USD</option>
                          <option value="EUR">EUR</option>
                        </select>
                        <template x-if="errors['to']">
                          <div class="invalid-feedback">
                            <template x-for="item in errors['to']" :key="item">
                              <div x-text="item"></div>
                            </template>
                          </div>
                        </template>
                    </div>
                    <button type="button" class="btn btn-primary" id="converter" x-on:click="
                    loading = true; 
                    errors = []; 
                    axios.get(`{{url('/')}}/api/converter?base=${$refs.base.value}&to=${$refs.to.value}&value=${$refs.value.value}`)
                    .then(function (response) {
                      $refs.result.innerText = response.data.value + ' ' + $refs.to.value;
                    })
                    .catch(function (error) {
                      if(error.response.status == 422){
                        errors = error.response.data.errors;
                        $refs.debug.innerText = JSON.stringify(errors);
                      } else {
                        fatalError = true;
                      }
                    });">Converter</button>
                    <div x-show="fatalError" style="display:none;" class="internal-error">
                      Erro Interno
                    </div>
                    <div x-ref="result" class="result"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
</body>
</html>