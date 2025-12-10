var express = require('express');
var router = express.Router();
const Project = require('../models/Project');

// CREATE FORM
router.get('/new', (req, res) => {
  res.render('projects/create');
});

// CREATE
router.post('/', async (req, res) => {
  try {
    await Project.create(req.body);
    res.redirect('/projects');
  } catch (err) {
    console.error(err);
    res.status(400).send(err.message);
  }
});

// READ ALL
router.get('/', async (req, res) => {
  try {
    const projects = await Project.find();
    res.render('projects/index', { projects });
  } catch (err) {
    res.status(500).send(err.message);
  }
});

// READ ONE (EDIT FORM)
router.get('/:id/edit', async (req, res) => {
  try {
    const project = await Project.findById(req.params.id);
    res.render('projects/edit', { project });
  } catch (err) {
    res.status(404).send("Projekt nije pronađen");
  }
});

// UPDATE
router.post('/:id', async (req, res) => {
  try {
    await Project.findByIdAndUpdate(req.params.id, req.body, { new: true });
    res.redirect('/projects');
  } catch (err) {
    res.status(400).send(err.message);
  }
});

// DELETE
router.post('/:id/delete', async (req, res) => {
  try {
    await Project.findByIdAndDelete(req.params.id);
    res.redirect('/projects');
  } catch (err) {
    res.status(500).send(err.message);
  }
});

// ADD MEMBER
router.post('/:id/members', async (req, res) => {
  try {
    const project = await Project.findById(req.params.id);
    project.clanovi.push(req.body.member_name);
    await project.save();
    res.redirect(`/projects/${req.params.id}/edit`);
  } catch (err) {
    res.status(400).send(err.message);
  }
});

// REMOVE MEMBER
router.post('/:id/members/delete', async (req, res) => {
  try {
    const project = await Project.findById(req.params.id);
    project.clanovi = project.clanovi.filter(clan => clan !== req.body.member_name);
    await project.save();
    res.redirect(`/projects/${req.params.id}/edit`);
  } catch (err) {
    res.status(400).send(err.message);
  }
});

module.exports = router;
