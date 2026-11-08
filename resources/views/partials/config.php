<?php
// ============================================================================
//  STATIC PORTFOLIO DATA
//  Edit everything in this single file to update all site content.
//  Anything set to null is treated as an editable placeholder in the UI.
// ============================================================================

return [
    'basic' => [
        'name'        => 'Angel Bio',
        'short_name'  => 'Angel Bio',
        'initials'    => 'AB',
        'title'       => 'IT Student | Aspiring Web Developer',
        'course'      => 'BSIT',
        'location'    => 'Salnec, Bucay, Abra',
        'email'       => 'bioangel29@gmail.com',
        'phone'       => '09279773552',
        'profile_pic' => 'image/Prof_photo.jpg',
        'headline'    => 'Do your work with passion and curiosity.',
        'headline_html' => 'Do your work with <em>passion</em> and <em>curiosity.</em>',
        'intro'       => "Hi, I'm Angel V. Bio — a passionate IT student with a love for web development. I believe in learning by doing, from coding to deploying, and my goal is to keep improving and build projects that are both useful and creative.",
        'intro_detail' => "I'm currently pursuing a Bachelor of Science in Information Technology at Data Center College of the Philippines Bangued, Abra, and completing my On-the-Job Training at the Land Registration Authority.",
        'intro_focus' => ['Encoding', 'Continuous Learning', 'Records Management'],
        'status'      => 'Currently Studying',
        'resume'      => 'resume/AngelBio_resume.pdf',
        'tagline'     => 'IT Student | Aspiring Web Developer',
        'socials'     => [
            ['label' => 'GitHub',   'url' => 'https://github.com/angel21-droid', 'icon' => 'github'],
            ['label' => 'Facebook', 'url' => 'https://www.facebook.com/profile.php', 'icon' => 'facebook'],
        ],
    ],

    'about' => [
        'headline'   => 'Curious Mind. Creative Approach.',
        'paragraphs' => [
            "I'm an Information Technology student who enjoys exploring technology, learning new skills, and creating digital solutions. I enjoy learning through practical experiences and continuously improving my technical and creative abilities.",
            "I'm currently pursuing a Bachelor of Science in Information Technology at Data Center College of the Philippines Bangued, Abra. Through my academic journey and personal projects, I continue developing my knowledge in programming, web development, and technology.",
            "I am also completing my On-the-Job Training at the Land Registration Authority.",
        ],
        'interests'  => ['Web Development', 'Technology', 'UI/UX Design', 'Learning New Programming Languages', 'Creative Projects'],
        'goals'      => 'To be successful and explore the world someday.',
        'background' => [
            ['label' => 'Education', 'value' => 'BSIT · Data Center College of the Philippines Bangued, Abra'],
            ['label' => 'Currently', 'value' => 'On-the-Job Training at the Land Registration Authority (LRA)'],
        ],
    ],

    'skills' => [
        [
            'title'   => 'Design Skills',
            'number'  => '01',
            'icon'    => 'pen',
            'summary' => 'Clean layout, structure, and visual presentation for the web.',
            'items'   => ['Basic Web Page Layout', 'Blade', 'CSS'],
            'layout'  => 'tags',
        ],
        [
            'title'   => 'Development Skills',
            'number'  => '02',
            'icon'    => 'code',
            'summary' => 'Languages and web technologies I use while building projects and learning by doing.',
            'items'   => ['PHP', 'Blade', 'HTML', 'CSS', 'JavaScript', 'Dart', 'Basic SQL'],
            'layout'  => 'chips',
        ],
        [
            'title'   => 'Tools & Technologies',
            'number'  => '03',
            'icon'    => 'tools',
            'summary' => 'The tools I rely on for development, collaboration, and everyday work.',
            'items'   => [
                ['name' => 'Visual Studio Code', 'mark' => 'VS'],
                ['name' => 'Microsoft Visual Studio', 'mark' => 'MV'],
                ['name' => 'GitHub', 'mark' => 'GH'],
                ['name' => 'Laravel', 'mark' => 'LA'],
                ['name' => 'Flutter', 'mark' => 'FL'],
                ['name' => 'Microsoft Office', 'mark' => 'MO'],
            ],
            'layout'  => 'tools',
        ],
        [
            'title'   => 'Other Skills',
            'number'  => '04',
            'icon'    => 'spark',
            'summary' => 'Personal strengths that support my learning and teamwork.',
            'items'   => ['Communication Skills', 'Time Management', 'Adaptability'],
            'layout'  => 'tags',
        ],
    ],

    'projects' => [
        [
            'name'         => 'P.E EMIS',
            'category'     => 'Web Development',
            'description'  => 'An EMIS created using VB.NET for school PE departments to track sports equipment inventory, manage student borrowing and return transactions, monitor item conditions, and generate real-time reports.',
            'technologies' => ['HTML'],
            'images'       => [
                'emis_project/emis_1.jpg',
                'emis_project/emis_2.jpg',
                'emis_project/emis_3.jpg',
                'emis_project/emis_4.jpg',
                'emis_project/emis_5.jpg',
                'emis_project/emis_6.jpg',
                'emis_project/emis_7.jpg',
                'emis_project/emis_8.jpg',
            ],
            'orientation'  => 'wide',
            'github'       => 'https://github.com/angel21-droid/P.E_EMIS.git',
            'live'         => null,
            'role'         => null,
        ],
        [
            'name'         => 'Bangued-Ka-Fuel',
            'category'     => 'Web Development',
            'description'  => 'A web-based GIS directory for retail gasoline stations in Bangued, Abra, built with Leaflet.js, Node.js, and SQLite. Features include interactive map layers, brand filtering, real-time pricing, and an Admin RBAC portal for station managers.',
            'technologies' => ['Leaflet.js', 'Node.js', 'SQLite', 'JavaScript', 'HTML', 'CSS'],
            'images'       => [
                'fuel_project/Kafuel1.jpg',
                'fuel_project/Kafuel2.jpg',
                'fuel_project/Kafuel3.jpg',
                'fuel_project/Kafuel4.jpg',
                'fuel_project/Kafuel5.jpg',
                'fuel_project/Kafuel6.jpg',
            ],
            'orientation'  => 'wide',
            'github'       => 'https://github.com/angel21-droid/Bangued_Ka_Fuel_LiveSys_Showcase.git',
            'live'         => 'https://bangued-ka-fuel.infinityfree.me',
            'role'         => 'Web developer involved in building the system.',
        ],
        [
            'name'         => 'AbraQuest: 2D Pixel Adventure',
            'category'     => 'Game Development',
            'description'  => 'A 2D pixel-art adventure game that lets players explore the province of Abra through quests, built with Unity and C#.',
            'technologies' => ['C#', 'Unity', '2D Game Development', 'Tilemap'],
            'images'       => [
                'abraquest_project/abraquest_1.jpg',
                'abraquest_project/abraquest_2.jpg',
                'abraquest_project/abraquest_3.jpg',
                'abraquest_project/abraquest_4.jpg',
                'abraquest_project/abraquest_5.jpg',
                'abraquest_project/abraquest_6.jpg',
                'abraquest_project/abraquest_7.jpg',
            ],
            'orientation'  => 'wide',
            'github'       => null,
            'live'         => 'https://blaz3333.itch.io/abra-quest',
            'role'         => null,
        ],
        [
            'name'         => 'Task Manager',
            'category'     => 'Android App',
            'description'  => 'An offline student monitoring and grade tracking mobile application designed for students to track subjects, assignments, assessments, and academic performance.',
            'technologies' => [],
            'images'       => [
                'gtrack_project/gtracker_1.jpg',
                'gtrack_project/gtracker_2.jpg',
                'gtrack_project/gtracker_3.jpg',
                'gtrack_project/gtracker_4.jpg',
                'gtrack_project/gtracker_5.jpg',
                'gtrack_project/gtracker_6.jpg',
            ],
            'orientation'  => 'portrait',
            'github'       => null,
            'live'         => null,
            'role'         => null,
        ],
        [
            'name'         => 'My Portfolio Website',
            'category'     => 'Web Development',
            'description'  => 'A personal website to showcase my projects, skills, and experiences.',
            'technologies' => ['Blade', 'CSS', 'PHP', 'JavaScript'],
            'images'       => [
                'portfolio_project/portfolio_project.png',
                'portfolio_project/portfolio_project2.png',
            ],
            'orientation'  => 'wide',
            'github'       => null,
            'live'         => 'https://myportfoliobioangel.vercel.app/',
            'role'         => null,
        ],
    ],

    'certificates' => [
        [
            'title'    => 'Introduction to Modern AI',
            'issuer'   => 'DICT-ITU DTC Initiative through the Cisco Networking Academy program',
            'date'     => 'October 31, 2026',
            'category' => 'Artificial Intelligence',
            'image'    => 'certificate/previews/certificate_CISCO_IntroModernAI.jpg',
            'pdf'      => 'certificate/certificate_CISCO_IntroModernAI.pdf',
            'verify'   => null,
        ],
        [
            'title'    => 'Understanding Startups & Getting Your Idea Ready for the Philippine Startup Challenge XI',
            'issuer'   => 'DICT',
            'date'     => 'September 7, 2026',
            'category' => 'Startup',
            'image'    => 'certificate/previews/certificate_DICT_StartUp.jpg',
            'pdf'      => 'certificate/certificate_DICT_StartUp.pdf',
            'verify'   => null,
        ],
        [
            'title'    => 'Online Safety through Netiquette',
            'issuer'   => 'DICT',
            'date'     => 'July 23, 2026',
            'category' => 'Digital Safety',
            'image'    => 'certificate/previews/certificate_DICT_OnlineSafety.jpg',
            'pdf'      => 'certificate/certificate_DICT_OnlineSafety.pdf',
            'verify'   => null,
        ],
    ],

    'education' => [
        [
            'level'    => 'Tertiary',
            'school'   => 'Data Center College of the Philippines Bangued, Abra',
            'location' => 'Ubbog, Lipcan, Zone 5, Bangued, Abra',
            'program'  => 'Bachelor of Science in Information Technology',
            'years'    => '2023–2027',
            'status'   => 'In progress',
        ],
        [
            'level'    => 'Secondary',
            'school'   => 'Dugong National High School',
            'location' => 'Dugong, Bucay, Abra',
            'program'  => 'General Academic Strand',
            'years'    => '2017–2023',
            'status'   => 'Completed',
        ],
    ],

    'experience' => [
        'ojt' => [
            'organization'     => 'Land Registration Authority (LRA)',
            'position'         => 'Intern',
            'duration'         => 'Currently Ongoing — until OJT completion',
            'responsibilities' => ['File Management', 'Encoding'],
            'description'      => 'Completing my On-the-Job Training at the Land Registration Authority, where I gain practical experience through administrative support and records-related work.',
        ],
    ],

    'contact' => [
        'heading_html' => "Let's Build Something <em>Meaningful.</em>",
        'message'      => "I'm always open to learning, connecting, and exploring new opportunities. Whether you want to discuss a project, share ideas, or simply connect, feel free to reach out. I'd be happy to hear from you!",
    ],

    'github' => [
        'username' => 'angel21-droid',
        'url'      => 'https://github.com/angel21-droid',
    ],
];
