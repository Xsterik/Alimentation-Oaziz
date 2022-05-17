import { Controller } from "@hotwired/stimulus";
import { useClickOutside, useDebounce } from "stimulus-use";

export default class extends Controller {
    static values = {
        url: String,
    }
    static targets = ['search'];

    static debounces = ['search']

    connect() {
        useClickOutside(this);
        useDebounce(this);
    }

    onSearchInput(event) {
        // if (event.currentTarget.value.length >= 3) {
        this.search(event.currentTarget.value);
        // } else {
        //     this.clickOutside();
        // }

    }

    async search(query) {
        const params = new URLSearchParams({
            search: query,
            preview: 1,
        })

        const response = await fetch(`${this.urlValue}?${params.toString()}`);
        // console.log(await response.text());
        this.searchTarget.innerHTML = await response.text();
    }

    clickOutside(event) {
        this.searchTarget.innerHTML = '';
    }

}