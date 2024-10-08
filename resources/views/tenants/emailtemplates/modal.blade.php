  <!-- Modal -->
  <div class="modal fade" id="placeholderModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ __('emailtemplate.form.placeholder') }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <ul>
                      @foreach ($placehoders as $placeholder)
                          <li>
                              <span id="copy_button_{{ $placeholder->id }}" rel="{{ $placeholder->name }}">
                                  {{ $placeholder->name }}</span> <i class="bi bi-copy"
                                  onclick="copyToClipboard(this.id)" id="copy_copy_button_{{ $placeholder->id }}"
                                  rel="copy_button_{{ $placeholder->id }}">Copy</i>
                          </li>
                      @endforeach
                  </ul>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
