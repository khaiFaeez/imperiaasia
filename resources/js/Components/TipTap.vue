<script>
import StarterKit from '@tiptap/starter-kit'
import { Editor, EditorContent } from '@tiptap/vue-3'

export default {
    components: {
        EditorContent
    },

    props: {
        modelValue: {
            type: String,
            default: ''
        }
    },

    watch: {
        modelValue(value) {
            // HTML
            const isSame = this.editor.getHTML() === value

            // JSON
            // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

            if (isSame) {
                return
            }

            this.editor.commands.setContent(value, false)
        }
    },

    data() {
        return {
            editor: null
        }
    },

    mounted() {
        this.editor = new Editor({
            extensions: [StarterKit],
            content: this.modelValue,
            onUpdate: () => {
                // HTML
                this.$emit('update:modelValue', this.editor.getHTML())

                // JSON
                // this.$emit('update:modelValue', this.editor.getJSON())
            }
        })
    },

    beforeUnmount() {
        this.editor.destroy()
    },

    emits: ['update:modelValue']
}
</script>

<style>
.ProseMirror {
    height: 400px;
}
</style>

<template>
    <div v-if="editor">
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleBold().run()"
            :class="{ 'is-active': editor.isActive('bold') }"
        >
            bold
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleItalic().run()"
            :class="{ 'is-active': editor.isActive('italic') }"
        >
            italic
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleStrike().run()"
            :class="{ 'is-active': editor.isActive('strike') }"
        >
            strike
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleCode().run()"
            :class="{ 'is-active': editor.isActive('code') }"
        >
            code
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().unsetAllMarks().run()"
        >
            clear marks
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().clearNodes().run()"
        >
            clear nodes
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().setParagraph().run()"
            :class="{ 'is-active': editor.isActive('paragraph') }"
        >
            paragraph
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
        >
            h1
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
        >
            h2
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
        >
            h3
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }"
        >
            h4
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleHeading({ level: 5 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }"
        >
            h5
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleHeading({ level: 6 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }"
        >
            h6
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleBulletList().run()"
            :class="{ 'is-active': editor.isActive('bulletList') }"
        >
            bullet list
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleOrderedList().run()"
            :class="{ 'is-active': editor.isActive('orderedList') }"
        >
            ordered list
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleCodeBlock().run()"
            :class="{ 'is-active': editor.isActive('codeBlock') }"
        >
            code block
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().toggleBlockquote().run()"
            :class="{ 'is-active': editor.isActive('blockquote') }"
        >
            blockquote
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().setHorizontalRule().run()"
        >
            horizontal rule
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().setHardBreak().run()"
        >
            hard break
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().undo().run()"
        >
            undo
        </button>
        <button
            class="btn btn-outline btn-sm"
            @click="editor.chain().focus().redo().run()"
        >
            redo
        </button>
    </div>

    <editor-content :editor="editor" />
</template>
