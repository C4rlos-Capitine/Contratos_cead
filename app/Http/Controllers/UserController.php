<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \App\Models\User;

class UserController extends Controller
{

    public function reg_user(){
        return view('user.register_form');
    }

    public function user_profile(){
        //$user = User::find($id);
        return view('user.profile');
    }

    public function save(Request $request){
         // Validação dos dados recebidos
        // Regras de validaçã
       // Log::info("Requisição recebida no método save_user.", $request->all());
       //return response()->json(['response'=>$request->all()]);
        try{
            $rules = [
                'email' => 'required|email|unique:users,email',
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'tipo_user' => 'required|integer|in:1,2', // Ajuste conforme seus tipos de usuário
            ];
    
            // Mensagens de erro personalizadas
            $messages = [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O email deve ser um endereço de email válido.',
                'email.unique' => 'O email já está em uso.' ,
                'name.required' => 'O campo nome é obrigatório.',
                'name.max' => 'O nome não pode exceder 255 caracteres.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
                'tipo_user.required' => 'O tipo de usuário é obrigatório.',
                'tipo_user.in' => 'O tipo de usuário selecionado é inválido.',
            ];
    
            // Executa a validação
            $validator = Validator::make($request->all(), $rules, $messages);
    
            // Retorna erros de validação se houver falhas
            if ($validator->fails()) {
                return response()->json([
                    'response' => 'Erro de validação',
                    'errors' => $validator->errors(),
                ]);
            }
    
            // Criação do usuário no banco de dados
            /*$user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'tipo_user' => $request->input('tipo_user'),
            ]);*/
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->tipo_user = $request->input('tipo_user');
            $user->save();
    
            // Retorno de sucesso
            return response()->json([
                'response' => 'Usuário registrado com sucesso!',
            ],);
        }catch(\Exception $e){
            return response()->json(['response' => $e->getMessage()], 500);
        }
        
    }
    public function showUsers(){
        try{
            $users = User::select('*')
                ->where('tipo_user', 1)
                ->orWhere('tipo_user', 3)
                ->get();

            return response()->json(['response'=>$users]);
        }catch(\Exception $e){
            return response()->json(['response' => $e->getMessage()], 500);
        }

    }

    function edit_data(Request $request)
    {
        try {
            // Encontre o usuário pelo ID
            $user = User::find($request->id);

            // Certifique-se de que o usuário foi encontrado
            if (!$user) {
                return response()->json(['response' => 'Usuário não encontrado.', 'status' => 0]);
            }

            // Atualize apenas os campos fornecidos no request, mantendo os valores existentes caso não sejam fornecidos
            $updatedName = $request->name ?? $user->name;
            $updatedEmail = $request->email ?? $user->email;

            // Atualize o banco de dados
            $affected = DB::table('users')
                ->where('id', $request->id)
                ->update(['name' => $updatedName, 'email' => $updatedEmail]);

            // Retorne uma resposta com sucesso
            return response()->json(['response' => 'Dados actualizados com sucesso.', 'status' => 1]);

        } catch (\Exception $e) {
            // Retorne uma resposta com o erro
            return response()->json(['response' => $e->getMessage(), 'status' => 0]);
        }
    }


    public function change_password(Request $request){
        try{
            
            //return response()->json(['response' => $request->all()]);
                $rules = [
                    'senha_actaul' => 'required',
                    'senha_nova' => 'required|string|min:6',
                    'confirmar' => 'required|string|min:6', // Ajuste conforme seus tipos de usuário
                ];
                
                if($request->senha_nova != $request->confirmar){
                    return response()->json(['response'=>'Erro', 'errors'=>['Erro','A senha de confirmação não é a mesma que do campo nova senha'], 'status'=>0]);
                }
                // Mensagens de erro personalizadas
                $messages = [
                    'senha_actaul.required' => 'O campo senha é obrigatório.',
                    'senha_nova.required' => 'O campo senha é obrigatório.',
                    'confirmar.required' => 'Confirme a senha',
                    'senha_nova.min'=>  'A senha deve ter pelo menos 6 caracteres.',
                ];
        
                // Executa a validação
                $validator = Validator::make($request->all(), $rules, $messages);
        
                // Retorna erros de validação se houver falhas
                if ($validator->fails()) {
                    return response()->json([
                        'response' => 'Erro de validação',
                        'errors' => $validator->errors(),
                        'status' =>0
                    ]);
                }

                // Buscar o usuário e verificar a senha atual
                $user = User::find($request->id);
               // Log::info("Requisição recebida no método save_user.", ['user_s'=>$user]);
                if (!$user) {
                    return response()->json([
                        'response' => 'Erro',
                        'errors' => ['Usuário não encontrado.'],
                        'status' => 0
                    ]);
                }
               // $password_hash = Hash::make($user->password)
                $check = Hash::check($request->senha_actaul, $user->password);
                //Log::info("password check", ['user_s'=>$check]);
                //Log::info("password check", ['password'=>$user->password, 'resquest_pass'=>$request->senha_actaul]);
                if (!$check) {
                    return response()->json([
                        'response' => 'Erro',
                        'errors' => ['A senha atual está incorreta.'],
                        'status' => 0
                    ]);
                }

                // Atualizar a senha
                DB::table('users')
                ->where('id', $request->id)
                ->update(['password' => Hash::make($request->senha_nova)]);
                Log::info("Requisição recebida no método save_user.", ['user_update'=>$affected]);
              return response()->json(['response'=>'password alterada com sucesso', 'status' =>1]);

        }catch(\Exception $e){

        }
    }
}
