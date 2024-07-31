@extends('base_layout')


@section('content')
<div class="qutehub-panel">

    <div class="qutehub-panel-header">

        <h2>Personal Quiz List</h2>

        <div id="PQL-search-bar" class="qutehub-input-with-icon">

            <img class="qutehub-img" src=" {{ URL::asset('/icons/search.png') }}">
            <input id="quiz-search-input" class="qutehub-merge-element" placeholder="Search Quiz">
        </div>


        <!-- <div class="qutehub-input-with-icon PQL-search-bar" style="height: fit-content;">
            <img class="qutehub-img" src="{{ URL::asset('/icons/search.png') }}">
            <input type="text" class="qutehub-merge-element" placeholder="Search List">
        </div> -->

        <!-- <img src="{{ URL::asset('/icons/list.png') }}" style="width: 50px; background-color: rgb(141, 141, 141); padding: 5px; border-radius: 5px;"> -->
    </div>

    <div class="qutehub-panel-content">

        <div class="personal-quiz-list-container">
            <div class="PQL-header-row">
                <label>No.</label>
                <label>Name</label>
                <label>Action</label>
            
            </div>
            <label id="empty-PQL-warning">List is empty</label>
            <div id="personal-quiz-list">
                @foreach ($quizzes as $quiz)    
                    <div class="PQL-row" id="quiz-{{ $quiz->id }}">
                        <label>{{ $loop->iteration }}.</label>
                        <label class="quiz-name">{{ $quiz->name }}</label>

                        <div class="PQL-row-action-list">
                            <img src=" {{ URL::asset('/icons/info_1.png') }}" style="width: 20px;">
                            <img src="{{ URL::asset('/icons/delete_1.png') }}" style="width: 20px;" onclick="confirmDeletion('{{ $quiz->id }}', '{{ $quiz->name }}')">
                        </div>
                    </div>
                
                @endforeach
            </div>
        </div>
    </div>

    <!-- <div class="qutehub-panel-content">
        
        <div class="filter-panel">
            <fieldset class="input-design-one">
                <legend>Sort By</legend>

                <select class=" input-design-one qutehub-fieldset-input">
                    <option value="">Popularity</option>
                    <option value="">Creation Date</option>
  
                </select>
            </fieldset>
        </div>

        
        


        <div class="quiz-list">

        
            <div class="quiz-list-header">
                <label>No.</label>
                <label>Name</label>
                <label>Created At</label>
                <label>Actions</label>
            </div>    


            @foreach ($quizzes as $quiz)
                <div class="quiz-list-element" id="quiz-{{ $quiz->id }}">
                    <label>{{ $loop->iteration }}.</label>
                    <label>{{ $quiz->name }}</label>
                    <label>{{ $quiz->created_at }}</label>
                    <div class="img-wrapper">
                        <img src="{{ URL::asset('/icons/info_1.png') }}" style="width: 25px;">
                    </div>
                    <div class="img-wrapper" onclick="confirmDeletion('{{ $quiz->id }}', '{{ $quiz->name }}')">
                        <img src="{{ URL::asset('/icons/delete_1.png') }}" style="width: 25px;">
                    </div>
                </div>
            @endforeach
        </div>     

    </div> -->

    
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
</div>


@endsection
