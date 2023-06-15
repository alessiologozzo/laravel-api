@extends('layouts.admin')


<div class="al-confirm d-none">
    <div class="d-flex flex-column">
        <span>Sicuro di voler cancellare questo progetto? Questa azione è <strong
                class="text-danger">irreversibile</strong></span>
    </div>

    <div class="d-flex justify-content-center align-items-center gap-4 pt-4">
        <div onclick="window.Func.removeConfirmElement()" class="al-round al-red">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div onclick="window.Func.submitFormIndex(window.Var.projectIndex)" class="al-round al-green">
            <i class="fa-solid fa-check"></i>
        </div>
    </div>
</div>


@section('content')


    @if (session()->has('mex'))
        <div class="al-mex">
            <i>{{ session()->get('mex') }}</i>
        </div>
    @endif


    <div class="d-flex align-items-center gap-5 pb-4">
        <h1>I tuoi progetti</h1>

        <a href="{{ route('admin.project.create') }}">
            <i class="fa-solid fa-square-plus add-project-plus"></i>
        </a>
    </div>

    <hr>

    <div class="d-flex flex-column align-items-start gap-3 px-4 border-start border-end border-secondary">


        @for ($i = 0; $i < count($projects); $i++)
            <h3>{{ $projects[$i]->name }}</h3>

            <h6>{{ $projects[$i]->description }}</h6>

            <div class="d-flex flex-wrap align-items-start gap-3">
                @foreach ($projects[$i]->technologies as $technology)
                    <h4 class="badge {{$technology->bg_color}}">{{ $technology->name }}</h4>
                @endforeach
            </div>


            <div class="align-self-end d-flex gap-3">
                <a href="{{route('admin.project.edit', $projects[$i]->slug)}}">
                    <i class="fa-solid fa-edit al-icon"></i>
                </a>
                <i onclick="window.Func.askConfirm(event); window.Var.projectIndex = {{ $i + 1 }};"
                    class="fa-solid fa-trash al-icon hover-red"></i>
            </div>
            <hr class="w-100">

            <form action="{{ route('admin.project.destroy', $projects[$i]->id) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endfor


    </div>


    <div class="pagination py-3">
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>


    <a href="{{route('admin.project.create')}}">
        <strong class="text-lightgreen text-decoration-underline">Crea un nuovo progetto</strong>
    </a>

@endsection
