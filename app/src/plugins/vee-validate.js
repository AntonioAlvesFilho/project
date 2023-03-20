import { defineRule } from 'vee-validate'
import {
  required,
  email,
  min,
  max,
  confirmed,
  alpha_spaces
} from '@vee-validate/rules'
defineRule('required', required)
defineRule('email', email)
defineRule('min', min)
defineRule('max', max)
defineRule('alpha_spaces', alpha_spaces)
defineRule('confirmed', confirmed)

//o Tiago matos fez o tutorial usando uma versão antiga da biblioteca,
//o jeito foi improvisar e tentar importar com a nova sintaxe e torçer
//pra conseguir substituir o que ele colocar no decorrer das aulas

//abaixo o comando para definir TODAS as rules da biblioteca(afeta o desempenho da aplicação)

// import { defineRule } from 'vee-validate';
// import AllRules from '@vee-validate/rules';
// Object.keys(AllRules).forEach(rule => {
//   defineRule(rule, AllRules[rule]);
// });
