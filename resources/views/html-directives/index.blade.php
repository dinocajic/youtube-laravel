<div>
    <label for="isActive">Is Active?</label>
    <input type="checkbox"
           id="isActive"
           name="isActive"
           value="isActive"
           @checked( old('isActive', $isActiveVar) ) />
</div>

<div>
    <label for="isActiveTwo">Is Active Two?</label>
    <input type="checkbox"
           id="isActiveTwo"
           name="isActiveTwo"
           value="isActiveTwo"
           @checked( $isActiveVar ) />
</div>

<div>
    <label for="car">Car Select</label>
    <select name="car" id="car">
        @foreach ($cars as $car)
            <option value="{{ $car->make }}" @selected(old('car') == $car->make)>
            {{ $car->make }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <button type="submit" @disabled($errors->isNotEmpty())>Submit</button>
</div>

<div>
    <label for="email">Email</label>
    <input type="email"
           name="email"
           value="{{$user->email}}"
           @readonly($user->isNotAdmin()) />
</div>

<div>
    <label for="subject">Subject</label>
    <input type="text"
           id="subject"
           name="subject"
           @required($isRequired) />
</div>
