<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_renders_every_scaffolded_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        foreach (['hero', 'about', 'statistics', 'skills', 'projects', 'experience', 'education', 'certificates', 'engineering-lab', 'contact'] as $section) {
            $response->assertSee('data-section="' . $section . '"', false);
        }
    }

    public function test_home_page_has_a_single_h1_and_skip_link(): void
    {
        $response = $this->get('/');

        $this->assertSame(1, substr_count($response->getContent(), '<h1'));
        $response->assertSee('href="#main-content"', false);
    }
}
