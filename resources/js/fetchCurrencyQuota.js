function fetchCurrencyQuota (){
    axios.get('http://localhost:8000/api/converter?base=EURs&to=BRL&value=2')
    .then(function (response) {
      console.log(response.data.value);
    })
    .catch(function (error) {
      if(error.response.status == 422){
          let errArr = [];
          const errs = error.response.data.errors;
          for(let err in errs){
            errArr = [...errs[err], ...errArr];
          }
          console.log(errArr);
      } else {
          console.log(['Erro interno.']);
      }
    });
}

fetchCurrencyQuota();