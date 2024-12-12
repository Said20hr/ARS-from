<div class="formbold-main-wrapper min-h-screen bg-[#141414] ">
    <img src="{{ asset('images/ARS-cover-event-faceboo.png') }}" class="absolute  w-full object-cover inset-x-0 top-0" alt="img-bold">
    <div class="xl:max-w-3xl xl:p-6 p-3 rounded-md mx-auto bg-white mt-28 xl:mt-[500px]">
        <div class="">
            <div class="my-4 font-semibold text-primary text-base xl:text-xl">ÉVÉNEMENTS</div>
            <h4 class="font-semibold text-black my-3 text-sm xl:text-xl">Demande d'inscription  - Algeria Rise Summit (ARS) 2024</h4>
        </div>
        @if(session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <strong>Succès!</strong> {{ session('message') }}
            </div>
        @else
        <form wire:submit.prevent="submit">
            @if($currentStep == 0)
                <div class="formbold-welcome-step">
                    <div class="formbold-form-title">Bienvenue à l'Algeria Rise Summit 2024</div>
                    <p class="text-sm xl:text-base mt-4 leading-7">
                        Merci pour votre intérêt pour l'Algeria Rise Summit 2024, qui se tiendra le <strong>14 décembre 2024</strong> au <strong>Bastion 23, à Alger</strong>.
                    </p>
                    <p class="text-sm xl:text-base my-8 bg-gray-100 p-2 rounded ">
                        ⚠️ Les places sont limitées. Ce formulaire constitue une candidature qui sera examinée par nos équipes. Vous serez contacté si votre demande est retenue.
                    </p>
                    <button type="button" wire:click="nextStep" class="formbold-btn">Commencer</button>
                </div>
            @endif
                @if($currentStep > 0)
                    <!-- Progress Bar -->
                    <div class="progress-container mb-6">
                        <div class="progress-bar" style="width: {{ ($currentStep / $totalSteps) * 100 }}%;"></div>
                        <div class="progress-label text-center mt-2">
                            {{ round(($currentStep / $totalSteps) * 100) }}% -
                            @switch($currentStep)
                                @case(1)
                                    Informations personnelles
                                    @break
                                @case(2)
                                    Informations professionnelles
                                    @break
                                @case(3)
                                    Motivation pour participer
                                    @break
                                @case(4)
                                    Informations supplémentaires
                                    @break
                            @endswitch
                        </div>
                    </div>

                    <!-- Step Indicators -->
                    <div class="formbold-steps-indicator flex justify-end xl:gap-4 gap-2 mb-6">
                        @foreach(range(1, $totalSteps) as $step)
                            <span class="py-1 xl:text-sm px-2 text-xs  xl:px-3 rounded-full {{ $currentStep == $step ? 'bg-primary text-white' : 'bg-gray-200 text-gray-600' }}">
                                Étape {{ $step }}
                            </span>
                        @endforeach
                    </div>
                @endif
                @if($currentStep == 1)
                    <h2 class="formbold-form-title uppercase mb-2">Informations personnelles</h2>
                    <div class="flex flex-col gap-6">
                        <div class="formbold-input-flex">
                            <div>
                                <label for="name" class="formbold-form-label">Nom et prénom*</label>
                                <input type="text" id="name" wire:model="name" class="formbold-form-input" required />
                                @error('name') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                            </div>
                            <div>
                                <label for="email" class="formbold-form-label">Adresse email*</label>
                                <input type="email" id="email" wire:model="email" class="formbold-form-input" required />
                                @error('email') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="formbold-form-label">Numéro de téléphone*</label>
                            <input type="text" id="phone" wire:model="phone" class="formbold-form-input" required />
                            @error('phone') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>
                    </div>
                @endif
                <!-- Step 2: Job Information -->
                @if($currentStep == 2)
                    <h2 class="formbold-form-title">Informations professionnelles</h2>
                    <div class="flex flex-col gap-6">
                        <div>
                            <label for="job_title" class="formbold-form-label">Intitulé du poste*</label>
                            <input type="text" id="job_title" wire:model="job_title" class="formbold-form-input" required />
                            @error('job_title') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>
                        <div>
                            <label for="company_name" class="formbold-form-label">Nom de l’entreprise/organisation*</label>
                            <input type="text" id="company_name" wire:model="company_name" class="formbold-form-input" required />
                            @error('company_name') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>
                        <div>
                            <label for="industry" class="formbold-form-label">Secteur d'activité*</label>
                            <select id="industry" wire:model.live="industry" class="w-full py-3 px-3 font-semibold border-[#dde3ec] text-[#151f35] rounded bg-white">
                                <option value="">-- Sélectionnez --</option>
                                <option value="technologies">Technologies</option>
                                <option value="sante">Santé</option>
                                <option value="finance">Finance</option>
                                <option value="education">Éducation</option>
                                <option value="industrie">Industrie</option>
                                <option value="autres">Autres (précisez ci-dessous)</option>
                            </select>
                            @if($industry == 'autres')
                                <input type="text" wire:model="industry_other" required placeholder="Précisez" class="formbold-form-input mt-2" />
                            @endif
                            @error('industry') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                            @error('industry_other') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>

                    </div>
                @endif
                <!-- Step 3: Event Motivation -->
                @if($currentStep == 3)
                    <div class="flex flex-col gap-6">
                        <h2 class="formbold-form-title">Motivation pour participer</h2>
                        <div>
                            <label for="motivation" class="formbold-form-label">
                            Pourquoi souhaitez-vous participer à l’Algeria Rise Summit ?*
                            </label>
                            <textarea id="motivation" wire:model="motivation" class="formbold-form-input" required></textarea>
                            @error('motivation') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>
                        <div>
                            <label for="contribution" class="formbold-form-label">
                                Comment pensez-vous que votre présence contribuera à l’événement ?*
                            </label>
                            <textarea id="contribution" wire:model="contribution" class="formbold-form-input" required></textarea>
                            @error('contribution') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>
                    </div>
                @endif
                <!-- Step 4: Additional Information -->
                @if($currentStep == 4)
                    <div class="flex flex-col gap-6">
                        <h2 class="formbold-form-title">Informations supplémentaires</h2>
                        <div>
                            <label for="previous_event" class="formbold-form-label">Avez-vous déjà participé à un événement similaire ?*</label>
                            <select id="previous_event" wire:model.live="previous_event" class="w-full py-3 px-3 font-semibold border-[#dde3ec] text-[#151f35] rounded bg-white">
                                <option value="">-- Sélectionnez --</option>
                                <option value="yes">Oui</option>
                                <option value="no">Non</option>
                            </select>
                            @if($previous_event == 'yes')
                                <textarea type="text" wire:model="previous_event_details" required placeholder="Précisez lequel"
                                          class="formbold-form-input mt-2"></textarea>
                                @error('previous_event_details') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                            @endif
                            @error('previous_event') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>
                        <div>
                            <label for="heard_about" class="formbold-form-label">Comment avez-vous entendu parler de l’Algeria Rise Summit ?*</label>
                            <select id="heard_about" wire:model.live="heard_about" class="w-full py-3 px-3 font-semibold border-[#dde3ec] text-[#151f35] rounded bg-white">
                                <option value="">-- Sélectionnez --</option>
                                <option value="social_media">Réseaux sociaux (LinkedIn, Facebook)</option>
                                <option value="press">Presse (TV, journaux)</option>
                                <option value="recommendation">Recommandation personnelle</option>
                                <option value="other">Autre (précisez ci-dessous)</option>
                            </select>
                            @if($heard_about == 'other')
                                <textarea type="text" rows="5" wire:model="heard_about_other" required placeholder="Précisez" class="formbold-form-input mt-2"></textarea>
                                @error('heard_about_other') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                            @endif
                            @error('heard_about') <span class="mt-2 text-sm text-red-500"> {{ $message }} </span>  @enderror
                        </div>
                    </div>
                @endif
                @if($currentStep > 0)
                    <div class="flex justify-between mt-8 gap-4">
                    @if($currentStep > 0)
                        <button type="button" wire:click="previousStep" class="formbold-btn-pre">Précédent</button>
                    @endif
                    @if($currentStep < $totalSteps)
                        <button type="button" wire:click="nextStep" class="formbold-btn">Suivant</button>
                    @else
                        <button type="submit" class="formbold-btn">Soumettre</button>
                    @endif
                </div>
                @endif
        </form>
        @endif
    </div>
</div>
