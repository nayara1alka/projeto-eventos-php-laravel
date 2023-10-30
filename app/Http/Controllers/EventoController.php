<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;

class EventoController extends Controller
{
   public function index()
   {

      $search = request('search');

      if ($search) {
         $eventos = Evento::where([['titulo','like','%'.$search.'%']])->get();
      } else {
         $eventos = Evento::all();
      }

      return view('welcome', ['eventos' => $eventos, 'search' => $search]);
   }

   public function criar()
   {
      return view('eventos.criar');
   }

   public function store(Request $request)
   {
      $evento = new Evento();

      $evento->titulo = $request->titulo;
      $evento->descricao = $request->descricao;
      $evento->cidade = $request->cidade;
      $evento->privado = $request->privado;
      $evento->itens_infraestrutura = $request->itens_infraestrutura;
      $evento->data = $request->data;

      if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
         $requestImagem = $request->imagem;

         $extensao = $requestImagem->extension();

         $NomeImagem = md5($requestImagem->getClientOriginalName() . strtotime('now')) . '.' . $extensao;

         $requestImagem->move(public_path('img/eventos'), $NomeImagem);

         $evento->imagem = $NomeImagem;
      }

      $user = auth()->user();
      $evento->user_id = $user->id;

      $evento->save();

      return redirect('/')->with('msg', 'Evento criado com sucesso!');
   }

   public function show($id)
   {
      $evento = Evento::findOrFail($id);
      $user = auth()->user();
      $hasUserJoined = false;

      if($user){
         $hasUserEventos = $user->eventosParticipante->toArray();

         foreach($hasUserEventos as $userEvento){
            if($userEvento['id'] == $id){
               $hasUserJoined = true;
            }

         }
      }

      $donoEvento = User::Where('id', $evento->user_id)->first()->toArray();

      return view('eventos.show', ['evento' => $evento, 'donoEvento' => $donoEvento, 'hasUserJoined' => $hasUserJoined]);
   }

   public function dashboard(){
      $user = auth()->user();

      $eventos = $user->eventos;

      $eventosParticipante = $user->eventosParticipante;

      return view('eventos.dashboard', ['eventos' => $eventos,'eventosParticipante' => $eventosParticipante ]);
   }

   public function destroy($id){
      Evento::findOrFail($id)->delete();

      return redirect('/dashboard')->with('msg', 'Evento removido com suceso!');
   }

   public function editar($id){
      $user = auth()->user();
       $evento = Evento::findOrFail($id);

       if($user->id != $evento->user_id){
          return redirect('/dashboard');
       }

       return view('eventos.editar',['evento' => $evento]);
   }
   
   public function atualizar(Request $request){
      $data = $request->all();

      if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
         $requestImagem = $request->imagem;

         $extensao = $requestImagem->extension();

         $NomeImagem = md5($requestImagem->getClientOriginalName() . strtotime('now')) . '.' . $extensao;

         $requestImagem->move(public_path('img/eventos'), $NomeImagem);

         $data['imagem'] = $NomeImagem;
      }

      Evento::findOrFail($request->id)->update($data);
      return redirect('/dashboard')->with('msg', 'Evento Editado com sucesso!');
   }

   public function joinEvento($id){
      $user = auth()->user();
      $user->eventosParticipante()->attach($id);
      $evento = Evento::findOrFail($id);
      return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $evento->titulo);
   }

   public function leaveEvento($id){
      $user = auth()->user();
      $user->eventosParticipante()->detach($id);

      $evento = Evento::findOrFail($id);
      return redirect('/dashboard')->with('msg', 'Você  saiu com sucesso do evento ' . $evento->titulo);

   }
}
