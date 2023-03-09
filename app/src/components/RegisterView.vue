<template>
  <main class="form-signin w-100 m-auto">
    <form>
      <h1 class="h3 mb-4 fw-normal text-center">Sign Up!</h1>

      <div class="form-floating mb-3 align-center">
        <label for="name">Name</label>
        <input
          type="text"
          class="form-control"
          id="floatingName"
          placeholder="Horacio" />
      </div>

      <div class="form-floating mb-3 align-center">
        <label for="floatingEmail">Email address</label>
        <input
          type="email"
          class="form-control"
          id="floatingEmail"
          placeholder="name@example.com" />
      </div>

      <div class="form-floating">
        <label class="" for="FloatinfDate">Date of Birth</label>
        <div class="form-floating mb-3">
          <input
            class="input-check-input"
            type="date"
            name="floatingDate"
            id="floatingDate" />
        </div>
      </div>

      <div class="form-floating mb-3">
        <label>Gender</label>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="flexRadioDefault"
            id="flexRadioDefault1" />
          <label class="form-check-label" for="flexRadioDefault1"> Male </label>
        </div>

        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="flexRadioDefault"
            id="flexRadioDefault2"
            checked />
          <label class="form-check-label" for="flexRadioDefault2">
            Female
          </label>
        </div>

        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="flexRadioDefault"
            id="flexRadioDefault3"
            disabled />
          <label class="form-check-label" for="flexRadioDefault3">
            Other
          </label>
        </div>
      </div>

      <div class="form-floating mb-3 align-center">
        <label for="floatingPassword">Password</label>
        <input
          type="password"
          class="form-control"
          id="floatingPassword"
          placeholder="Password" />
      </div>

      <div class="form-floating mb-5 align-center">
        <label for="floatingConfirmPassword">Confirm Password</label>
        <input
          type="password"
          class="form-control"
          id="floatingConfirmPassword"
          placeholder="Confirm Password" />
      </div>

					<!-- password plus confirm password, moron  -->
			<Field name="password" type="password" />
  <Field name="confirmation" type="password" rules="confirmed:@password" />

      <button class="w-100 btn btn-lg btn-primary" type="submit">
        Sign Up
      </button>

      <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>
  </main>
</template>
