<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Controle de formulário do modelo especificado
 * @author Thiago Farias <thiago.amarante.farias@gmail.com>
 * @version 06/03/2018
 */
class FodaseFormRequest extends FormRequest
{
    /**
     * Determina se o usuário pode realizar o request
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Seta os rules para cada campo
     *
     * @return array
     */
    public function rules() {
        return [
            'nome' => ['required'],
            'carro' => ['required'],
            'teste' => ['formato_invalido_cpf'],
        ];
    }
    
    /**
     * Mensagens caso pare nos rules atribuidos
     * @return array
     */
    public function messages() {
        return [
                        
                        
                                                'nome.required' => 'O campo "Nome" não foi preenchido.',            
                        
                                                'carro.required' => 'O campo "Carro" não foi preenchido.',            
                        
                                                            
                        
            'teste.formato_invalido_cpf' => 'CPF inválido.',                                ];
    }
    
    
    /**
     * Pega a instancia de validação e adiciona o validador
     * @return type
     */
    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();
                                                                        $validator->addImplicitExtension('formato_invalido_cpf', function($attribute, $value, $parameters) {
            if ($value && !\App\Http\Helper\Validate::cpf($value)) {
                return false;
            }
            return true;
        });
                        return $validator;
    }
}